<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('categories', function (Blueprint $table) {
			$table->id();
			$table->foreignId('parent_id')->nullable()->constrained('categories')->cascadeOnDelete();
			$table->string('name');
			$table->string('name_ru')->nullable();
			$table->string('slug')->unique();
			$table->unsignedInteger('sort_order')->default(1);
			$table->boolean('is_home')->default(0);
			$table->boolean('is_active')->default(1);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('categories');
	}
};
