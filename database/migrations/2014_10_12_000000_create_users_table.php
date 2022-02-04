<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('org_id')->constrained('organisations');
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->boolean('is_admin')->default(false);
            $table->integer('survey_count')->default(0);
            $table->boolean('is_survey_onging')->default(false);
            $table->timestamp('last_taken')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
