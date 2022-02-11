<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCniirIndicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cniir_indices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('org_id')->constrained('organisations');
            $table->foreignId('quadrant_id')->constrained('quadrants');
            $table->decimal('score')->default(0);
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
        Schema::dropIfExists('cniir_indices');
    }
}
