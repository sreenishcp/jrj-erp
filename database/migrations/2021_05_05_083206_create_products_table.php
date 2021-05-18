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
            $table->string('name',100);
            $table->double('cost')->default(0);
            $table->double('selling_price');
            $table->integer('supplier_id')->default(0);
            $table->integer('category_id');
            $table->integer('unit_id');
            $table->string('quandity',100);
            $table->string('images');
            $table->text('note')->nullable();
            $table->integer('branch_id');
            $table->boolean('status')->default(0);
            $table->boolean('isDeleted')->default(0);
            // $table->enum('veg_or_non',array('veg','non'))->default('veg');
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
