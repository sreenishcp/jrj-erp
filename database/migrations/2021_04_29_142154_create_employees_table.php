<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('phone',20);
            $table->string('designation');
            $table->string('email',150);
            $table->boolean('status')->default(0);
            $table->boolean('verification_status')->default(0);
            $table->string('proof_type',100);
            $table->string('proof',100);
            $table->string('image',100)->nullable();
            $table->text('address');
            $table->integer('branch_id')->default(0);
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
        Schema::dropIfExists('employees');
    }
}
