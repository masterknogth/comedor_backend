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
        Schema::create('personals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula')->unique();
            $table->string('numero')->nullable();
            $table->string('apellidos');
            $table->string('nombres');
            $table->string('exonerado')->nullable();
            $table->string('inactivo')->nullable();
            $table->integer("departamento")->unsigned()->index()->nullable();
            $table->foreign("departamento")->references("code")->on("departaments")->onDelete('CASCADE');
            $table->string('tipo');
            $table->string('mes')->nullable();
            $table->string('acumulado')->nullable();
            $table->string('ingreso')->nullable();
            $table->string('mensaje')->nullable();
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
        Schema::dropIfExists('personals');
    }
};
