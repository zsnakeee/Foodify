export default (productId, initialPrice, initialQuantity = 1) => ({
    quantity: initialQuantity,
    price: initialPrice,
    total: initialPrice * initialQuantity,
    loading: false,
    currency: Alpine.store('currency').get,
    locale: Alpine.store('locale').get,
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
        return this.formatPrice(this.price);
    },
    formattedTotal() {
        return this.formatPrice(this.total);
    },
    formatPrice(price) {
        return new Intl.NumberFormat(this.locale, {
            style: 'currency',
            currency: this.currency
        }).format(price);
    },
});
