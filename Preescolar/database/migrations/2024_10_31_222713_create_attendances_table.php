<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
    TABLA ASISTENCIAS
     * CREATE TABLE asistencias(
     * asistenciaID int AUTO_INCREMENT not null PRIMARY KEY,
     * fecha DATE,
     * claseID int,
     * estudianteID int,
     * FOREIGN KEY (claseID) REFERENCES clases(claseID),
     * FOREIGN KEY (estudianteID) REFERENCES estudiantes(estudianteID)
     * );
    */

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id('asistenciaID');
            $table->date('fecha');
            $table->foreignId('estudianteID');//FOREIGN
            $table->foreignId('claseID');//FOREIGN
            $table->timestamps();
        
            $table->foreign('claseID')
            ->references('claseID')
            ->on('assignatures');
            
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
        Schema::dropIfExists('attendances');
    }
};
