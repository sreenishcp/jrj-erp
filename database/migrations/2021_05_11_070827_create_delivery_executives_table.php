<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryExecutivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_executives', function (Blueprint $table) {
            $table->id();
            $table->enum('method',array('own','others'));
            $table->string('others')->nullable();
            $table->string('others_delivery_person')->nullable();
            $table->integer('delivery_person')->nullable();
            $table->enum('delivery_vehicle_type',array('own','company','others'));
            $table->integer('delivery_vehicle_id')->default(0);
            $table->double('distance');
            $table->date('delivery_date');
            $table->string('delivery_time');
            $table->boolean('status')->default(0);
            $table->integer('branch_id');
            $table->text('delivery_note')->nullable();
            $table->boolean('isDeleted')->default(0);
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
        Schema::dropIfExists('delivery_executives');
    }
}
