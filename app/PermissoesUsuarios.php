<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PermissoesUsuarios extends Model {

    public $primaryKey = 'id_permissao_usuario';
    public $table = 'permissoes_usuarios';
    public $fillable = array('id_user', 'id_permissao');
    public $timestamps = false;

    public function getDataGrid() {

        $query = DB::table($this->table)
                        ->join('permissoes', 'permissoes.id_permissao', '=', 'permissoes_usuarios.id_permissao')
                        ->join('users', 'users.id', '=', 'permissoes_usuarios.id_user')
                        ->select('permissoes_usuarios.*', 'permissoes.*')
                        ->get()->toArray();

        return $query;
    }

    public function getPermissao($idUser, $nameMethod) {

        $query = DB::table($this->table)
                        ->join('permissoes', 'permissoes.id_permissao', '=', 'permissoes_usuarios.id_permissao')
                        ->join('users', 'users.id', '=', 'permissoes_usuarios.id_user')
                        ->select('permissoes_usuarios.*')
                        ->where('user.id', '=', $idUser)
                        ->where('permissoes.nome', '=', $nameMethod)
                        ->get()->toArray();

        return $query;
    }

}
