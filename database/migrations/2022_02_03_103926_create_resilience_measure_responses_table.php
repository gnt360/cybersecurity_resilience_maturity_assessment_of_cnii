<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResilienceMeasureResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resilience_measure_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rm_id')->constrained('resilience_measures');
            $table->foreignId('rms_id')->constrained('resilience_measure_scales');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('resilience_measure_responses');
    }
}
