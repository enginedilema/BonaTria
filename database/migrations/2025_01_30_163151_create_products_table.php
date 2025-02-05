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
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->string('packaging')->nullable();
            $table->boolean('published')->default(true);
            $table->string('thumbnail')->nullable();
            $table->decimal('unit_price', 8, 2)->nullable();
            $table->decimal('bulk_price', 8, 2)->nullable();
            $table->integer('unit_size')->nullable();
            $table->string('size_format')->nullable();
            $table->decimal('tax_percentage', 5, 3)->nullable();
            $table->decimal('previous_unit_price', 8, 2)->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->timestamps();
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
