<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions_meta', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('submission_id')->unsigned()->index();
            //$table->foreign('submission_id')->references('id')->on('submission')->onDelete('cascade');

            $table->string('type')->default('null');

            $table->string('key')->index();
            $table->text('value')->nullable();

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
        Schema::drop('submission_meta');
    }
}
