<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
    TABLA INSTALACIONES
     * CREATE TABLE instalaciones(
     * instalacionID int AUTO_INCREMENT not null PRIMARY KEY, 
     * ubicacion varchar(50) not null,
     * imagen varchar(255),
     * salones int(10)
     * );
    */

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('instalations', function (Blueprint $table) {
            $table->id('instalacionID');
            $table->string('nombre', 30);
            $table->string('ubicacion', 50);
            $table->string('imagen', 255)->nullable();
            $table->integer('salones');
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instalations');
    }
};
