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
            $table->string('titulo')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('solucion')->nullable();
            $table->timestamp('fecha_creacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('fecha_solucion')->nullable()->default(null);
            $table->string('img_error')->nullable();
            $table->string('creado_por')->nullable();
            $table->string('solucionado_por')->nullable();
            $table->unsignedBigInteger('plataforma_id')->nullable();
            $table->unsignedBigInteger('cliente_id')->nullable();
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
