<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovelsAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites_admins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('novel_id')->unsigned();
            $table->integer('admin_id')->unsigned();

            $table->unique(['novel_id', 'admin_id']);

            $table->foreign('novel_id')
                ->references('id')
                ->on('novels');
            $table->foreign('admin_id')
                ->references('id')
                ->on('admins');
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
        Schema::table('favorites_admins', function (Blueprint $table) {
            //
        });
    }
}
