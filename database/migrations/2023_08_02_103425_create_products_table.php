<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product');
            $table->decimal('rgPrice')->default(0.00);
            $table->decimal('slPrice')->default(0.00);
            $table->decimal('halfPrice')->nullable();
            $table->string('prodImg');
            $table->string('description')->nullable();
            $table->string('category')->default('Single');
            $table->string('customize')->default('No');
            $table->string('type');
            $table->string('tags')->nullable();
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
