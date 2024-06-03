<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->integer('total_users')->unsigned();

            $table->string('users_title');

            $table->string('users_description');

            $table->integer('users_min')->unsigned();

            $table->integer('users_max')->unsigned();

            $table->float('total_deposits')->unsigned();

            $table->string('deposits_title');

            $table->string('deposits_description');

            $table->integer('deposits_min')->unsigned();

            $table->integer('deposits_max')->unsigned();

            $table->float('total_withdraws')->unsigned();

            $table->string('withdraws_title');

            $table->string('withdraws_description');

            $table->integer('withdraws_min')->unsigned();

            $table->integer('withdraws_max')->unsigned();

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
        Schema::dropIfExists('statistics');
    }
};
