<?php

namespace App\Services\Product;


class RecentViews extends Storage
{
    protected string $key = 'recentViews';
    protected string $driver = 'session';
}
