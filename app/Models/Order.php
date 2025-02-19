<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Notifications\OrderPaid;
use App\Observers\OrderObserver;
use App\Services\Cart\ExtendedCart;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[ObservedBy([OrderObserver::class])]
class Order extends Model
{
    protected $fillable = [
        'user_id',
        'shipping_address_id',
        'total',
        'currency',
        'discount',
        'promo_code',
        'status',
        'payment_id',
        'payment_method',
        'payment_status',
        'note',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
        'payment_status' => PaymentStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shippingAddress(): HasOne
    {
        return $this->hasOne(Address::class, 'id', 'shipping_address_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    protected function number(): Attribute
    {
        return Attribute::make(
            get: fn () => str_pad($this->id, 8, '0', STR_PAD_LEFT),
        );
    }

    public function scopeMy(Builder $query): Builder
    {
        return $query->where('user_id', auth()->id());
    }

    public function decrementStock(): void
    {
        $this->details->each(function (OrderDetail $detail) {
            $detail->product->lockForUpdate()->decrement('quantity', $detail->quantity);

            // event update stock
        });
    }

    public function paid($notify = true): void
    {
        $this->update(['payment_status' => PaymentStatus::PAID, 'status' => OrderStatus::PROCESSING]);
        $this->decrementStock();

        dispatch(function () use ($notify) {
            $notify && $this->user->notify(new OrderPaid($this));
        });
    }
}
