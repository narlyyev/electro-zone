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
        Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->string('group_code')->index();
			$table->foreignId('category_id')->constrained()->cascadeOnDelete();
			$table->foreignId('brand_id')->constrained()->cascadeOnDelete();
			$table->foreignId('color_id')->nullable()->constrained('attribute_values')->cascadeOnDelete();
			$table->string('name');
			$table->string('name_ru')->nullable();
			$table->string('slug')->unique();
			$table->longText('description');
			$table->longText('description_ru')->nullable();
			$table->string('barcode')->unique()->nullable();
			$table->decimal('price');
			$table->unsignedInteger('stock')->default(0);
			$table->unsignedFloat('discount_percent')->default(0);
			$table->dateTime('discount_start')->useCurrent();
			$table->dateTime('discount_end')->useCurrent();
			$table->string('image')->nullable();
			$table->boolean('is_active')->default(0);
			$table->unsignedInteger('sold')->default(0);
			$table->boolean('is_recommended')->default(0);
			$table->unsignedInteger('viewed')->default(0);
			$table->dateTime('image_updated_at')->nullable();
			$table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
