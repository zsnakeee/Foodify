import wishlistHandler from './handlers/wishlist.js';
import cartHandler from './handlers/cart.js';
import shoppingCartHandler from './handlers/shoppingCart.js';


document.addEventListener('alpine:init', () => {
    Alpine.store('cartCount', 0);
    Alpine.data('wishlistHandler', wishlistHandler);
    Alpine.data('cartHandler', cartHandler);
    Alpine.data('shoppingCartHandler', shoppingCartHandler);
});

