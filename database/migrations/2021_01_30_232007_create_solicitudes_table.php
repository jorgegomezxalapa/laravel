<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
          $table->bigIncrements('id');
            $table->string('fecha',64)->nullable();
              $table->string('folio',64)->nullable();
                $table->string('agente',64)->nullable();
                  $table->string('cliente',64)->nullable();
                    $table->string('solicitante',64)->nullable();
                    $table->string('responsable',64)->nullable();
                    $table->text('comentario',65535)->nullable();
                    $table->boolean('urgente')->nullable();
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
        Schema::dropIfExists('solicitudes');
    }
}
