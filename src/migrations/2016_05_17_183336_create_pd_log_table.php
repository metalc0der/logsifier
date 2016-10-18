<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePdLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log', function(Blueprint $table) {

            $table->increments('log_id');
            $table->integer('user_id')->unsigned();
            $table->string('ip', 15);
            $table->datetime('log_date');
            $table->string('object', 50);
            $table->mediumInteger('object_id');
            $table->text('description');
            $table->string('source',100)->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::drop('log');

    }
}
