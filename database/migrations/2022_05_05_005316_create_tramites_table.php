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
        Schema::create('tramites', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('identificador')->unique();
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('tipo_cedula')->nullable();
            $table->string('cedula')->nullable()->unique();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('pais')->nullable();
            $table->timestamp('fecha_egreso')->nullable();
            $table->json('motivos')->nullable();
            $table->boolean('encomienda')->nullable();
            $table->string('nucleo')->nullable();
            $table->string('carrera')->nullable();
            $table->boolean('pago')->nullable();
            $table->string('total')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tramites');
    }
};
