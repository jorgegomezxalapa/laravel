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
            $table->string('fecha',250)->nullable();
              $table->string('folio',250)->nullable();
                $table->string('agente',250)->nullable();
                  $table->string('cliente',250)->nullable();
                    $table->string('solicitante',250)->nullable();
                    $table->string('responsable',250)->nullable();
                    $table->string('comentario',250)->nullable();
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
