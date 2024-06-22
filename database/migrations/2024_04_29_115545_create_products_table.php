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
            
        //'category_id',
        
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->mediumText('small_description');
            $table->longText('description');
            $table->string('original_price');
            $table->string('selling_price');
            $table->string('image');
            $table->string('qty');
            $table->string('max_to_buy');
            $table->string('tax');
            $table->boolean('status')->default(true);
            $table->boolean('trending')->default(false);
            $table->mediumText('meta_title');
            $table->mediumText('meta_keywords');
            $table->mediumText('meta_description');
            $table->softDeletes();
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
