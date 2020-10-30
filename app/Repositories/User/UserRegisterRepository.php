<?php

namespace App\Repositories\User;

use App\Http\Requests\User\UserRegisterRequest;
use App\Models\User;
use App\Repositories\User\Interfaces\IUserRegisterRepository;
use Error;
use Illuminate\Support\Facades\Hash;

class UserRegisterRepository implements IUserRegisterRepository{

    public function store(UserRegisterRequest $request) {

        try {
            $user = new User();

            $user->name =  $request->name;
            $user->email =  $request->email;
            $user->password =  Hash::make($request->password);

            $user->save();
        } catch (\Throwable $th) {
            throw new Error('Falha ao cadastrar o cliente', 500);
        }
    }
}
