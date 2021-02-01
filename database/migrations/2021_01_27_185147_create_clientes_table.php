<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
              $table->string('razonSocial',250)->nullable();
                $table->string('representante',250)->nullable();
                $table->string('conatencion',250)->nullable();
                  $table->string('rfc',250)->nullable();
                    $table->string('email',250)->nullable();
                      $table->string('telefono',250)->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
