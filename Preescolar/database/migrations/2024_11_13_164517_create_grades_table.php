<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id('calificacionID');
            $table->string('nombreEstudiante');
            $table->foreignId('estudianteID');//foranea
            $table->double('primerBloque');
            $table->double('segundoBloque');
            $table->double('tercerBloque');
            $table->double('cuartoBloque');
            $table->double('quintoBloque');
            $table->double('sextoBloque');
            $table->double('calificacionFinal');
            $table->timestamps();

            $table->foreign('estudianteID')
            ->references('estudianteID')
            ->on('students');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
