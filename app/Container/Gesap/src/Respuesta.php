<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
        protected $connection = 'gesap';

    protected $table = 'tbl_respuesta';

    protected $primaryKey = 'PK_RPST_idMinr008';

    protected $fillable = ['RPST_RMin','RPST_Requerimientos','FK_TBL_Radicacion_id'];
    
    public function observaciones() {
        return $this->belongsto('App\container\Users\src\Observaciones','FK_TBL_Observaciones_id','PK_BVCS_idObservacion');
    }

    
}