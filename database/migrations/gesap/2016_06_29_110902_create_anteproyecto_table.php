<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnteproyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('gesap')->create('TBL_Anteproyecto', function (Blueprint $table) {
            $table->increments('PK_NPRY_IdMctr008');
            $table->string('NPRY_Titulo', 500);
            $table->String('NPRY_Keywords', 300);
            $table->integer('NPRY_Duracion');
            $table->date('NPRY_FechaR');
            $table->date('NPRY_FechaL');
            $table->integer('FK_NPRY_Estado')->unsigned();
            $table->foreign('FK_NPRY_Estado')
                ->references('PK_EST_Id')
                ->on('tbl_Estado_Anteproyecto')
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
        Schema::dropIfExists('TBL_Anteproyecto');
    }
}
