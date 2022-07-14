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
        Schema::create('patients', function (Blueprint $table) {
            $table->bigInteger('mobile_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('dob');
            $table->integer('age');
            $table->string('gender');
            $table->string('ethnicity');
            $table->string('relationship_status');
            $table->string('highest_education');
            $table->timestamps();
//            $table->boolean('interview_completed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
