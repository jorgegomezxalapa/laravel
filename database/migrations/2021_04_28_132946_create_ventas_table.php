<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('idCotizacion')->nullable();
             $table->integer('idCliente')->nullable();
             $table->integer('idSolicitante')->nullable();
            $table->string('subtotal',250)->nullable();
            $table->string('iva',250)->nullable();
            $table->string('ieps',250)->nullable();
            $table->string('total',250)->nullable();
            $table->integer('disponiblecompra')->nullable();
            $table->string('disponiblecompraEvidencia',250)->nullable();
            $table->integer('comprada')->nullable();
            $table->string('compradaEvidencia',250)->nullable();
            $table->integer('disponibleentrega')->nullable();
            $table->string('disponibleentregaEvidencia',250)->nullable();
            $table->integer('entregada')->nullable();
            $table->string('entregadaEvidencia',250)->nullable();
            $table->integer('disponiblefactura')->nullable();
            $table->string('disponiblefacturaEvidencia',250)->nullable();
            $table->integer('facturada')->nullable();
            $table->string('facturadaEvidencia',250)->nullable();
            $table->integer('cobrada')->nullable();
            $table->string('cobradaEvidencia',250)->nullable();
            $table->integer('cobradasf')->nullable();  
            $table->string('cobradasfEvidencia',250)->nullable(); 
            
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
        Schema::dropIfExists('ventas');
    }
}
