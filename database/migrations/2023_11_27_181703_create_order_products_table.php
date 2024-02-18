<?php

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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
			$table->foreignId('order_id')->constrained()->cascadeOnDelete();
			$table->foreignId('product_id')->constrained()->cascadeOnDelete();
			$table->unsignedDouble('price')->default(0);
			$table->unsignedInteger('quantity')->default(0);
			$table->unsignedInteger('discount_percent')->default(0);
			$table->unsignedDouble('total_price')->default(0);
			$table->timestamp('created_at')->nullable();
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
