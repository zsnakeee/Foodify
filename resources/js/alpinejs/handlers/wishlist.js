export default (productId, initialIsWished = false) => ({
    isWished: initialIsWished,
    loading: false,
    toggleWishlist() {
        this.loading = true;
        this.isWished = !this.isWished;
        Livewire.dispatch('wishlist-toggle', {id: productId});
    },
    wishlistUpdated(event) {
        if (event.detail.id === productId) {
            setTimeout(() => {
                this.loading = false;
            }, 300);
        }
    }
});
