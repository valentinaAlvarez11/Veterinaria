<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailabilitiesTable extends Migration
{
    public function up()
    {
        Schema::create('availabilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('veterinarian_id');
            $table->string('day_of_week'); // Día de la semana (Monday, Tuesday, etc.)
            $table->time('start_time'); // Hora de inicio
            $table->time('end_time');   // Hora de fin
            $table->timestamps();

            $table->foreign('veterinarian_id')->references('id')->on('veterinarians')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('availabilities');
    }
}

