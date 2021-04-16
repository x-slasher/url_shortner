<?php
namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EloquentUser implements UserRepository
{
    public function create(array $data)
    {
        $user = new User;
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->user_name = $data['user_name'];
        $user->mobile_no = $data['mobile_no'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();
        return $user;
    }

    public function findUser()
    {
        return User::find(Auth::user()->id);

    }

    public function logout(object $data){
        return $data->user()->token()->revoke();
    }
}
