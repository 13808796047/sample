<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //只有自己能修改自己的资料
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id == $user->id;
    }

    //只有管理员才能删除别人，而不能删除自己
    public function destroy(User $currentUser, User $user)
    {
        return $currentUser->is_admin && $currentUser->id != $user->id;
    }

}
