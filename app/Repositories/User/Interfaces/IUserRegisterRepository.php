<?php

namespace App\Repositories\User\Interfaces;

use App\Http\Requests\User\UserRegisterRequest;

interface IUserRegisterRepository {
    public function store(UserRegisterRequest $request);
}
