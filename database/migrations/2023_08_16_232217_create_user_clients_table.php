<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_clients', function (Blueprint $table) {
            $table->id();
            $table->string('fullname',200);
            $table->string('gender',100);
            $table->string('phone',200);
            $table->string('email',200);
            $table->string('address',200);
            $table->string('city',200);
            $table->string('username',200);
            $table->string('password',200);
            $table->string('comment_product',200);
            $table->string('url',200)->nullable();
            $table->string('url_delete',200)->nullable();
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
        Schema::dropIfExists('user_clients');
    }
}
