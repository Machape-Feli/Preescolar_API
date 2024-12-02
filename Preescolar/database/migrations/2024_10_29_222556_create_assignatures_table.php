<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
    TABLA CLASES
     * CREATE TABLE clases( //FOREIGN
     * claseID int AUTO_INCREMENT not null PRIMARY KEY,
     * nombre varchar(50) not null,
     * grupo int(10) not null,
     * salon varchar(10) not null,
     * turno varchar(10),
     * instructorID int,
     * FOREIGN KEY (instructorID) REFERENCES instructores(instructorID)
     * );
    */
    
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assignatures', function (Blueprint $table) {
            $table->id('claseID');
            $table->string('clase', 50);
            $table->integer('grupo');
            //$table->string('salon', 10);
            //$table->string('turno', 10);
            $table->string('estado');
            $table->foreignId('instructorID');//FOREIGN
            $table->timestamps();

            $table->foreign('instructorID')
            ->references('instructorID')
            ->on('teachers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignatures');
    }
};
