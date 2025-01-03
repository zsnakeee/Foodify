<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    /** @use HasFactory<\Database\Factories\PromoCodeFactory> */
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'start_at',
        'end_at',
        'is_active',
        'usage_limit',
        'usage_count',
        'usage_per_user',
    ];

    public function isExpired(): bool
    {
        return now()->isAfter($this->end_at);
    }

    public function isUsed(): bool
    {
        return $this->usage_limit > 0 && $this->usage_count >= $this->usage_limit;
    }

    public function hasReachedUsageLimit(): bool
    {
        return $this->usage_limit > 0 && $this->usage_count >= $this->usage_limit;
    }

    public function isUsable(): bool
    {
        return $this->is_active && ! $this->isExpired() && ! $this->isUsed();
    }

    public function userRedeemsCount(User $user): int
    {
        return PromoCodeHistory::where('promo_code_id', $this->id)
            ->where('user_id', $user->id)
            ->count();
    }

    public function validate(): ?string
    {
        return match (true) {
            $this->isExpired() => __('Promo code is expired'),
            $this->hasReachedUsageLimit() => __('Promo code has reached its usage limit'),
            ! $this->is_active || ($this->start_at && now() < $this->start_at) => __('Promo code is not active'),
            $this->userRedeemsCount(auth()->user()) >= $this->usage_per_user => __('You have reached the maximum usage of this promo code'),
            default => null,
        };
    }
}
