import wishlistHandler from './handlers/wishlist.js';

document.addEventListener('alpine:init', () => {
    Alpine.data('wishlistHandler', wishlistHandler);
    Alpine.data('cartHandler', (productId, initialPrice, initialQuantity = 1, currency = 'USD', locale = 'en') => ({
        quantity: initialQuantity,
        price: initialPrice,
        total: initialPrice * initialQuantity,
        loading: false,
        updateCart() {
            if (this.quantity === '')
                return;

            this.loading = true;
            Livewire.dispatch('cart-update', {id: productId, quantity: this.quantity});
        },
        increment() {
            this.quantity++;
            this.total += this.price;
        },
        decrement() {
            if (this.quantity > 1) {
                this.quantity--;

                this.total -= this.price;
            }
        },
        formattedPrice() {
            return new Intl.NumberFormat(locale, {
                style: 'currency',
                currency: currency
            }).format(this.total);
        },
        cartUpdated() {
            this.loading = false;
        }
    }));


});

