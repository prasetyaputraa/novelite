<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovelsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novel_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('novel_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->unique(['novel_id', 'user_id']);

            $table->foreign('novel_id')
                ->references('id')
                ->on('novels');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
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
        Schema::table('novel_user', function (Blueprint $table) {
            //
        });
    }
}
