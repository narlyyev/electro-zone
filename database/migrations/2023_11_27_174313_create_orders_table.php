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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained()->cascadeOnDelete();
			$table->string('code')->unique();
			$table->string('customer_name');
			$table->string('customer_phone');
			$table->string('customer_address')->nullable();
			$table->string('customer_note')->nullable();
			$table->unsignedDouble('products_price')->default(0);
			$table->unsignedDouble('delivery_fee')->default(0);
			$table->unsignedDouble('total_price')->default(0);
			$table->unsignedTinyInteger('platform')->default(0);
			$table->unsignedTinyInteger('status')->default(0);
			$table->timestamp('created_at');
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
