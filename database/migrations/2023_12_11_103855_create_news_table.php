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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
			$table->foreignId('category_id')->constrained('news_categories')->cascadeOnDelete();
			$table->string('name');
			$table->string('name_ru')->nullable();
			$table->string('name_en')->nullable();
			$table->text('description');
			$table->text('description_ru')->nullable();
			$table->text('description_en')->nullable();
			$table->string('image')->nullable();
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
