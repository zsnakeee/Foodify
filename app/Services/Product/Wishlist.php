<?php

namespace App\Services\Product;

class Wishlist extends Storage
{
    protected string $key = 'wishlist';
    protected string $driver = 'session';
}
