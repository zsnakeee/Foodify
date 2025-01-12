<?php

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('shipping_address_id')->constrained('addresses')->cascadeOnDelete();
            $table->decimal('total');
            $table->decimal('discount')->default(0);
            $table->string('promo_code')->nullable();
            $table->enum('status', OrderStatus::values())->default(OrderStatus::PENDING);
            $table->string('payment_id')->nullable();
            $table->string('payment_method');
            $table->enum('payment_status', PaymentStatus::values())->default(PaymentStatus::UNPAID);
            $table->text('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
