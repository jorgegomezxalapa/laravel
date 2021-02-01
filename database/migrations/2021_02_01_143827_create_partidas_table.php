<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->bigIncrements('id');
              $table->string('partida',250)->nullable();
                $table->string('descripcion',250)->nullable();
                  $table->string('unidadmedida',250)->nullable();
                    $table->string('cantidad',250)->nullable();
                      $table->string('precioproveedor',250)->nullable();
                        $table->string('utilidaddefault',250)->nullable();
                          $table->string('iva',250)->nullable();
                            $table->string('ieps',250)->nullable();
                              $table->string('importe1',250)->nullable();
                                $table->string('utilidadgenerada',250)->nullable();
                                  $table->string('preciounitario',250)->nullable();
                                    $table->string('importe2',250)->nullable();
                                      $table->string('idCotizacion',250)->nullable();
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
        Schema::dropIfExists('partidas');
    }
}
