<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname',100);
            $table->string('lastname',50)->nullable();
            $table->string('email',150);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',100);
            $table->string('phone',20);
            $table->boolean('status')->default(0);
            $table->integer('branch_id')->default(0);
            $table->boolean('isDeleted')->default(0);
            $table->enum('role', array('admin', 'user', 'manager','accountant','hr'))->default('user');
            $table->string('image',150)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
