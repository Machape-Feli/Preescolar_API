<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
    TABLA FAMILIARES
     * CREATE TABLE familiares(
     * familiarID int AUTO_INCREMENT not null PRIMARY KEY,
     * nombre varchar(50) not null,
     * apellidoP varchar(20) not null,
     * apellidoM varchar(20) not null,
     * correo varchar(50) not null,
     * contrasegna varchar(50) not null,
     * telefono varchar(10),
     * imagen varchar(255),
     * estatus varchar(20) not null
     * ); 
    */
    
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('relatives', function (Blueprint $table) {
            $table->id('familiarID');
            $table->string('nombre', 50);
            $table->string('apellidoP', 20);
            $table->string('apellidoM', 20);
            $table->string('correo', 50)->unique();
            $table->string('contrasena', 255);
            $table->string('telefono', 10)->nullable();
            $table->string('imagen', 255)->nullable();
            $table->string('estado', 20);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relatives');
    }
};
