<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problemas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->nullable();
            $table->string('solucion')->nullable();
            $table->date('fecha_creacion')->nullable(false)->change();
            $table->date('fecha_solucion');
            $table->string('img_error');
            $table->string('creado_por');
            $table->string('solucionado_por');
            $table->unsignedBigInteger('plataforma_id');
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('plataforma_id')
                ->references('id')
                ->on('plataformas')
                ->onDelete('cascade');
            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes')
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
        Schema::dropIfExists('problemas');
    }
}
