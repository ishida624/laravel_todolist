<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class T2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t1', function (Blueprint $table) {
            $table->integer('no', 16)->increments();
            $table->char('item', 255);
            $table->char('status', 8);
            $table->timestamp('update_time');
            $table->char('update_user', 16);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
