export default (products = [], total, currency = 'USD', locale = 'en') => ({
    products: products,
    currency: currency,
    locale: locale,
    total: total,
    subTotal: total,
    init() {
        Alpine.store('cartCount', Object.keys(this.products).length);
    },
    // discount: 0,

    refreshCart(event) {
        // Clear the current array
        this.products = [];
        // Replace it with the new array
        setTimeout(() => {
            this.products = event.detail.products;
            this.total = event.detail.total;
            this.subTotal = event.detail?.subTotal || event.detail.total;
            this.discount = event.detail?.discount || 0;
            Alpine.store('cartCount', Object.keys(this.products).length);
        }, 0); // Ensure Alpine re-renders by setting a timeout
    },
    formattedTotal() {
        return this.formatPrice(this.total);
    },
    formattedSubTotal() {
        return this.formatPrice(this.subTotal);
    },
    formattedDiscount() {
        return '-' + this.formatPrice(this.discount);
    },
    formatPrice(price) {
        return new Intl.NumberFormat(this.locale, {
            style: 'currency',
            currency: this.currency
        }).format(price);
    }
});
