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
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo');
            $table->string('cedula');
            $table->string('apellidos');
            $table->string('nombres');
            $table->string('sexo')->nullable();
            $table->integer("departamento")->unsigned()->index()->nullable();
            $table->foreign("departamento")->references("code")->on("departaments")->onDelete('CASCADE');
            $table->string('a_cursar')->nullable();
            $table->string('inactivo')->nullable();
            $table->string('fecha_rdoc')->nullable();
            $table->string('fecha_ret')->nullable();
            $table->string('mensaje')->nullable();
            $table->string('exonerado')->nullable();
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
        Schema::dropIfExists('students');
    }
};
