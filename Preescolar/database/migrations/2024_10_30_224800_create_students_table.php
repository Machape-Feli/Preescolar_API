<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
    TABLA ESTUDIANTES
     * CREATE TABLE estudiantes( //FOREIGN
     * estudianteID int AUTO_INCREMENT not null PRIMARY KEY,
     * nombre varchar(50) not null,
     * apellidoP varchar(20) not null,
     * apellidoM varchar(20) not null,
     * imagen varchar(255),
     * estatus varchar(20) not null,
     * claseID int,
     * FOREIGN KEY (claseID) REFERENCES clases(claseID)
     * );
    */

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id('estudianteID');
            $table->string('nombre', 50);
            $table->string('apellidoP', 20);
            $table->string('apellidoM', 20);
            $table->integer('grado')->nullable();
            $table->string('grupo')->nullable();
            $table->string('imagen', 255)->nullable();
            $table->string('estatus', 20);
            $table->foreignId('claseID'); //FOREIGN
            $table->timestamps();

            $table->foreign('claseID')
            ->references('claseID')
            ->on('assignatures');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
