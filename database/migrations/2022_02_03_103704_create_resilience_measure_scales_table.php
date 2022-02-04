<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResilienceMeasureScalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resilience_measure_scales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rm_id')->constrained('resilience_measures');
            $table->string('name');
            $table->integer('weight');
            $table->integer('order')->unique();
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
        Schema::dropIfExists('resilience_measure_scales');
    }
}
