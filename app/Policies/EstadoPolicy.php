<?php

namespace App\Policies;

use App\User;
use App\PermissoesUsuarios;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstadoPolicy {

    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    public function save(User $user, PermissoesUsuarios $userRoles) {
        return $user->id == $userRoles->id_user;
    }

    public function delete(User $user, PermissoesUsuarios $userRoles) {
        return $user->id == $userRoles->id_user;
    }

}
