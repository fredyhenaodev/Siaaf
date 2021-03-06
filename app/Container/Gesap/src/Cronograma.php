<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cronograma extends Model
{
    //modelo con el cual se guarda el coronograma del anteproyecto   
    protected $connection = 'gesap';

    protected $table = 'TBL_MCT_Cronograma';

    protected $primaryKey = 'PK_Id_Cronograma';

    protected $fillable = [
        'MCT_CRN_Actividad',
        'MCT_CRN_Semana_Inicio',
        'MCT_CRN_Semana_Fin',
        'MCT_CRN_Responsable',
        'FK_NPRY_IdMctr008'
    ];
    
}