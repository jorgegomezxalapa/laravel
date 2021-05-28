<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial', function (Blueprint $table) {
             $table->bigIncrements('id');
         
              $table->integer('idUsuario')->nullable();
               
                  $table->string('accion',164)->nullable();
                    $table->string('modulo',164)->nullable();
                    $table->string('descripcion',164)->nullable();
                   
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
        Schema::dropIfExists('historial');
    }
}
