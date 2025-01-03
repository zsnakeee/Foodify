<?php

namespace App\Services\Cart;

use App\Models\Product;
use App\Models\PromoCode;
use Gloudemans\Shoppingcart\Cart;
use Gloudemans\Shoppingcart\CartItem;

class ExtendedCart extends Cart
{
    public function wishlist(): ExtendedCart
    {
        return $this->instance('wishlist');
    }

    public function recentViews(): ExtendedCart
    {
        return $this->instance('recentViews');
    }

    public function shopping(): ExtendedCart
    {
        return $this->instance('shopping');
    }

    public function all(): array
    {
        return $this->content()->all();
    }

    public function add($id, $name = null, $qty = null, $price = null, $weight = 0, array $options = [])
    {
        if ($id instanceof Product) {
            $name = $id->name;
            $price = $id->price;
            $id = $id->id;
            $qty = $qty ?? 1;
        }

        return parent::add($id, $name, $qty, $price, $weight, $options);
    }

    public function update($rowId, $qty): void
    {
        if ($rowId instanceof Product) {
            $rowId = $this->content()->where('id', $rowId->id)->first()->rowId;
        }

        parent::update($rowId, $qty);
    }

    public function has($id): bool
    {
        if ($id instanceof Product) {
            return $this->content()->contains('id', $id->id);
        }

        return $this->content()->has($id);
    }

    public function get($rowId)
    {
        if ($rowId instanceof Product) {
            return $this->content()->where('id', $rowId->id)->first();
        }

        return parent::get($rowId);
    }

    public function remove($rowId): void
    {
        if ($rowId instanceof Product) {
            $rowId = $this->content()->where('id', $rowId->id)->first()->rowId;
        }

        parent::remove($rowId);
    }

//    public function total($decimals = null, $decimalPoint = null, $thousandSeperator = null): string
//    {
//        if ($decimals || $decimalPoint || $thousandSeperator) {
//            return parent::total($decimals, $decimalPoint, $thousandSeperator);
//        }
//
//        return format_price($this->totalFloat());
//    }
//
//    public function priceTotal($decimals = null, $decimalPoint = null, $thousandSeperator = null): string
//    {
//        if ($decimals || $decimalPoint || $thousandSeperator) {
//            return parent::total($decimals, $decimalPoint, $thousandSeperator);
//        }
//
//        return format_price($this->priceTotalFloat());
//    }
//
//    public function discount($decimals = null, $decimalPoint = null, $thousandSeperator = null): string
//    {
//        if ($decimals || $decimalPoint || $thousandSeperator) {
//            return parent::total($decimals, $decimalPoint, $thousandSeperator);
//        }
//
//        return format_price($this->discountFloat());
//    }

    public function products()
    {
        return $this->content()->map(function ($item, $rowId) {
            $product = Product::find($item->id);
            $product->qty = $item->qty;
            $product->img = $product->image_url;
            $product->category_name = $product->category->name;
            $product->category_slug = $product->category->slug;
            $product->rowId = $rowId;

            return $product;
        });
    }

    public function applyPromoCode(PromoCode $promo): void
    {
        $this->getContent()->each(function (CartItem $item) use ($promo) {
            $item->setDiscountRate($promo->value);
            $item->promoCode = $promo->code;
        });
    }

    public function removePromoCode(): void
    {
        $this->getContent()->each(function (CartItem $item) {
            $item->setDiscountRate(0);
            $item->promoCode = null;
        });
    }
}
