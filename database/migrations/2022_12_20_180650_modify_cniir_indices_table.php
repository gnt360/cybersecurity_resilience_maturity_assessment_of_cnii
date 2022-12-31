<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCniirIndicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cniir_indices', function (Blueprint $table) {
            $table->decimal('pre_event_rtd_score', 5,2);
            $table->decimal('during_event_rtd_score', 5,2);
            $table->decimal('post_event_rtd_score', 5,2);
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
