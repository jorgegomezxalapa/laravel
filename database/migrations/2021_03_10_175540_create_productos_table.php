<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('esMejora')->nullable();
              $table->boolean('esSolicitud')->nullable();
            $table->integer('idEmpleado')->nullable();
            $table->integer('idSegmento')->nullable();
            $table->text('descripcion',65535)->nullable();
            $table->string('unidaddemedida',80)->nullable();
            $table->float('cantidad', 8, 2)->nullable();
            $table->float('disponible', 8, 2)->nullable();
            $table->float('preciodelproveedor', 8, 2)->nullable();
            $table->string('marca',100)->nullable();
            $table->string('modelo',104)->nullable();
            $table->string('numerodeserie',140)->nullable();
            $table->boolean('politicasdegarantia')->nullable();
            $table->text('notasdelproducto',65535)->nullable();
            $table->string('archivosdenotas',191)->nullable();
            $table->string('miniatura',80)->nullable();
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
        Schema::dropIfExists('productos');
    }
}
