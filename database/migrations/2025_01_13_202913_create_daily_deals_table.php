<?php

use App\Enums\DiscountType;
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
        Schema::create('daily_deals', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('banner')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('discount')->nullable();
            $table->enum('discount_type', DiscountType::values())->default(DiscountType::PERCENTAGE);
            $table->timestamps();
        });

        Schema::create('daily_deal_products', function (Blueprint $table) {
            $table->foreignId('daily_deal_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_deals');
        Schema::dropIfExists('daily_deal_products');
    }
};
