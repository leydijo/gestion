<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoPlataformaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_plataforma', function (Blueprint $table) {
            $table->id();
            $table->string('estado');
            $table->date('fecha_creacion');
            $table->string('creado_por');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('plataforma_id');
            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes')
                ->onDelete('cascade');
            $table->foreign('plataforma_id')
                ->references('id')
                ->on('plataformas')
                ->onDelete('cascade');
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
        Schema::dropIfExists('estado_plataforma');
    }
}
