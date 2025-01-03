export default (productId, initialPrice, initialQuantity = 1, currency = 'USD', locale = 'en') => ({
    quantity: initialQuantity,
    price: initialPrice,
    total: initialPrice * initialQuantity,
    loading: false,
    addToCart() {
        if (this.quantity === '')
            return;
        Livewire.dispatch('cart-add', {id: productId, quantity: this.quantity});
    },
    updateCart(quantity = null) {
        Livewire.dispatch('cart-update', {id: productId, quantity: isNaN(quantity) ? this.quantity : quantity});
    },
    removeFromCart() {
        this.updateCart(0);
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
    formatPrice(price) {
        return new Intl.NumberFormat(locale, {
            style: 'currency',
            currency: currency
        }).format(price);
    },
    cartUpdated(event) {
        this.loading = false;
        // this.quantity = event.detail.quantity;
    }
});
