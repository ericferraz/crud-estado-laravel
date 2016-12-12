<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permissoes extends Model {

    protected $primaryKey = 'id_permissao';
    protected $table = 'permissoes';
    protected $fillable = array('nome', 'label');
    public $timestamps = false;

    public function getDataGrid() {
        $query = DB::table($this->table)->select('*')
                        ->orderBy('label', 'asc')
                        ->get()->toArray();
        return $query;
    }

}
