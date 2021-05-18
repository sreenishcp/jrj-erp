<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('last_name',100)->nullable();
            $table->string('email',150);
            $table->string('password',200);
            $table->string('phone',100);
            $table->string('door_number',100);
            $table->string('address_line',250);
            $table->string('postcode',100);
            $table->string('image',100)->nullable();
            $table->integer('branch_id');
            $table->boolean('member_status')->default(0);
            $table->boolean('email_verification_status')->default(0);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('customers');
    }
}
