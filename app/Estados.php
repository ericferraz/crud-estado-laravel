<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Estados extends Model {

    protected $primaryKey = 'id_estado';
    protected $table = 'estados';
    protected $fillable = array('nome_estado', 'sigla_estado', 'historico_estado');
    public $timestamps = false;
    public function getDataGrid() {
        $estados = DB::table($this->table)->select('*')
                        ->orderBy('nome_estado', 'asc')
                        ->get()->toArray();
        return $estados;
    }

}
