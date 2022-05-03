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
        Schema::create('temporals', function (Blueprint $table) {
            $table->id();
            $table->string('identificador')->unique();
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('tipo_cedula')->nullable();
            $table->string('cedula')->nullable()->unique();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable()->unique();
            $table->timestamp('fecha_nacimiento')->nullable();
            $table->json('motivos')->nullable();
            $table->boolean('encomienda')->nullable();
            $table->string('nucleo')->nullable();
            $table->string('total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temporals');
    }
};
