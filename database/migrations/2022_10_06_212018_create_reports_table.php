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
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula');
            $table->string('apellidos');
            $table->string('nombres');
            $table->integer("departamento")->unsigned()->index();
            $table->foreign("departamento")->references("code")->on("departaments")->onDelete('CASCADE');
            $table->string('tipo');
            $table->string('fecha');
            $table->string('hora');
            $table->integer("user_id")->unsigned()->index();
            $table->foreign("user_id")->references("id")->on("users")->onDelete('CASCADE');       
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
        Schema::dropIfExists('reports');
    }
};
