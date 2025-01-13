<div>
    <section class="flat-spacing-11">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <livewire:frontend.components.profile-navtab tab="orders"/>
                </div>


                <div class="col-lg-9">
                    <livewire:frontend.components.order-details :order_id="$order"/>
                </div>
            </div>
        </div>
    </section>
</div>
