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

    public function recentSearches(): ExtendedCart
    {
        return $this->instance('recentSearches');
    }

    public function all(): array
    {
        return $this->content()->all();
    }

    public function add($id, $name = null, $qty = null, $price = null, $weight = 0, array $options = [])
    {
        if ($id instanceof Product) {
            $name = $id->name;
            $price = $id->priceConverted;
            $id = $id->id;
            $qty = $qty ?? 1;
        }

        $options = [
            'currency' => config('app.currency'),
        ];

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

    public function products()
    {
        return $this->content()->map(function ($item, $rowId) {
            $product = Product::with('category')->find($item->id);
            $product->qty = $item->qty;
            $product->img = $product->image_url;
            $product->category_name = $product->category->name;
            $product->category_slug = $product->category->slug;
            $product->rowId = $rowId;
            $product->price = $product->priceConverted;
            $product->currency = $item->options['currency'];

            return $product;
        })->reverse();
    }

    //    public function totalFloat()
    //    {
    //        return $this->getContent()->reduce(function ($total, CartItem $cartItem) {
    //            return $total + $cartItem->total;
    //        }, 0);
    //    }

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

    public function promoCode(): ?string
    {
        return $this->content()->first()?->promoCode;
    }

    public function createOrder($address_id, $gateway)
    {
        $user = auth()->user();
        $address = $user->addresses()->find($address_id);
        $order = $user->orders()->create([
            'shipping_address_id' => $address->id,
            'total' => $this->totalFloat(),
            'currency' => $this->currency(),
            'discount' => $this->discountFloat(),
            'promo_code' => $this->promoCode(),
            'payment_id' => null,
            'payment_method' => $gateway,
        ]);

        $this->products()->each(function ($product) use ($order) {
            $order->details()->create([
                'product_id' => $product->id,
                'name' => $product->name,
                'quantity' => $product->qty,
                'price' => $product->price,
            ]);
        });

        return $order;
    }

    public function currency(): string
    {
        return $this->content()->first()?->options['currency'] ?? config('app.currency');
    }

    public function switchCurrency(string $currency): void
    {
        $this->getContent()->each(function (CartItem $item) use ($currency) {
            $item->price = config('app.default_currency') == $currency ?
                Product::find($item->id)->price :
                exchange($item->price, to: $currency, from: $item->options['currency']);
            $item->options['currency'] = $currency;
        });
    }
}
