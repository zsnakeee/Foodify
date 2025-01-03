import wishlistHandler from './handlers/wishlist.js';
import cartHandler from './handlers/cart.js';
import shoppingCartHandler from './handlers/shoppingCart.js';
import persist from '@alpinejs/persist'


document.addEventListener('alpine:init', () => {
    Alpine.store('cartCount', 0);
    Alpine.store('currency', {
        init() {
            this.get === null ? this.set('USD') : this.get;
        },
        get: localStorage.getItem('currency'),
        set(value) {
            localStorage.setItem('currency', value);
        }
    });
    Alpine.store('locale', {
        init() {
            this.get === null ? this.set('en') : this.get;
        },
        get: localStorage.getItem('locale'),
        set(value) {
            localStorage.setItem('locale', value);
        }
    });
    Alpine.data('wishlistHandler', wishlistHandler);
    Alpine.data('cartHandler', cartHandler);
    Alpine.data('shoppingCartHandler', shoppingCartHandler);
});

