<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('idSolicitud')->nullable();

            $table->string('estatus',250)->nullable();

                $table->string('utilidadGlobal',250)->nullable();
                $table->string('ivaGlobal',250)->nullable();
                $table->string('iepsGlobal',250)->nullable();

                  $table->string('ivaTotal',250)->nullable();
                  $table->string('iepsTotal',250)->nullable();
                  $table->string('subtotal',250)->nullable();
                  $table->string('total',250)->nullable();
                  $table->integer('disponiblecompra')->nullable();
                  $table->integer('disponiblefactura')->nullable();
                  $table->integer('comprada')->nullable();
                  $table->integer('disponibleentrega')->nullable();
                  $table->integer('entregada')->nullable();
                  $table->integer('cobrada')->nullable();
                  
                  $table->string('disponiblecompraEvidencia',250)->nullable();
                  $table->string('disponiblefacturaEvidencia',250)->nullable();
                  $table->string('compradaEvidencia',250)->nullable();
                  $table->string('disponibleentregaEvidencia',250)->nullable();
                  $table->string('entregadaEvidencia',250)->nullable();
                  $table->string('cobradaEvidencia',250)->nullable();

                $table->string('fechafinalizado',250)->nullable();
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
        Schema::dropIfExists('cotizaciones');
    }
}
