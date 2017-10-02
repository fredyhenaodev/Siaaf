<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Conceptos extends Model
{
        protected $connection = 'gesap';

    protected $table = 'tbl_conceptos';

    protected $primaryKey = 'PK_CNPT_Conceptos';

    protected $fillable = ['CNPT_Concepto','CNPT_Tipo','FK_TBL_Encargado_id'];
    
    public function conceptos() {
        return $this->belongsTo('App\container\gesap\src\Conceptos','FK_TBL_Encargado_id','PK_NCRD_idCargo');
    }
    
}
