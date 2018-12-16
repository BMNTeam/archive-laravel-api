<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('theme_number');
            $table->string('name');
            $table->integer('date');
            $table->longText('short_report_text');
            $table->string('short_report_url');
            $table->longText('full_report_text');
            $table->string('full_report_url');
            $table->string('presentation_url');

            $table->integer('manager_id')->unsigned();
            $table->foreign('manager_id')->references('id')->on('employees');

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
        Schema::dropIfExists('reports');
    }
}
