<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = [
        'email',
        'subscribed_at',
        'unsubscribed_at',
        'unsubscribed_reason',
    ];

    protected $dates = [
        'subscribed_at',
        'unsubscribed_at',
    ];

    protected static function boot(): void
    {
        parent::boot();
        parent::creating(function ($model) {
            $model->subscribed_at = now();
        });
    }

    public function scopeSubscribed($query)
    {
        return $query->whereNotNull('subscribed_at');
    }

    public function scopeUnsubscribed($query)
    {
        return $query->whereNotNull('unsubscribed_at');
    }
}
