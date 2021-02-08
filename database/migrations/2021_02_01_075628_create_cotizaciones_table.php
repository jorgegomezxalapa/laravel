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
              $table->string('idSolicitud',250)->nullable();
                $table->string('idUtilidad',250)->nullable();
                $table->string('estatus',250)->nullable();
                  $table->string('iva',250)->nullable();
                    $table->string('ieps',250)->nullable();
                      $table->string('subtotal',250)->nullable();
                        $table->string('total',250)->nullable();
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
