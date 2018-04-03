<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TipoPregunta extends Model
{
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Tipo_Pregunta';
    protected $primaryKey = 'PK_TPPG_Tipo_Pregunta';
    protected $fillable = ['TPPG_Tipo'];
    
    /*
    *Función de conexión entre las tablas de TBL_Tipo_Pregunta y TBL_Preguntas
    *por los campo de FK_TBL_Tipo_pregunta y PK_Tipo_Pregunta
    *para realizar las busquedas complementarias
    */   
    public function preguntasTiposPreguntas()
    {
        return $this->belongsto(TBL_Preguntas::class, 'FK_TBL_Tipo_Pregunta_Id', 'PK_TPPG_Tipo_Pregunta');
    }
}
