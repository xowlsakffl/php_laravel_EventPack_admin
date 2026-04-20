<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('udx');
            $table->string('uid', 50)->unique();
            $table->string('password');
            $table->string('name', 50);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_auth', 10)->default('N');
            $table->string('cell', 30)->nullable();
            $table->string('cell_auth', 10)->default('N');
            $table->string('tel', 30)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('join_from', 50)->nullable();
            $table->char('super', 1)->default('N');
            $table->unsignedTinyInteger('state')->default(10);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
