<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
    TABLA ContactoEstudiantes
     * CREATE TABLE contactoEstudiantes( //FOREIGN
     * contactoID int AUTO_INCREMENT not null PRIMARY KEY,
     * estudianteID int,
     * familiarID int,
     * FOREIGN KEY (estudianteID) REFERENCES estudiantes(estudianteID),
     * FOREIGN KEY (familiarID) REFERENCES familiares(familiarID)
     * );
    */

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_contacts', function (Blueprint $table) {
            $table->id('contactoID');
            $table->string('estado');
            $table->foreignId('estudianteID');//FOREIGN
            $table->foreignId('familiarID');//FOREIGN
            $table->timestamps();

            $table->foreign('estudianteID')
            ->references('estudianteID')
            ->on('students');
            
            $table->foreign('familiarID')
            ->references('familiarID')
            ->on('relatives');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_contacts');
    }
};
