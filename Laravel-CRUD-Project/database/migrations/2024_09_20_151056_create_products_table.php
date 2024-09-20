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
            $table->id();  // Primary key auto-incrementing ID
            $table->string('name');  // Product name
            $table->string('sku');  // Stock Keeping Unit
            $table->description('price', 10, 2);  // Price with precision (10 digits total, 2 after the decimal)
            $table->text('description')->nullable();  // Optional product description
            $table->string('image')->nullable();  // nullable() Optional image path
            $table->timestamps();  // Created at and updated at timestamps
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
