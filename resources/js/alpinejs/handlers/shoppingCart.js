export default (products = [], total, subTotal) => ({
    products: products,
    currency: Alpine.store('currency').get,
    locale: Alpine.store('locale').get,
    total: total,
    subTotal: total,
    discount: 0,
    init() {
        Alpine.store('cartCount', Object.keys(this.products).length);
    },
    // discount: 0,

    refreshCart(event) {
        // Clear the current array
        this.products = [];
        // Replace it with the new array
        setTimeout(() => {
            const {products, total, subTotal, discount} = event.detail;
            this.products = products;
            this.total = total;
            this.subTotal = subTotal || total;
            this.discount = discount || 0;
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
