<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRegisterRequest;
use App\Repositories\User\Interfaces\IUserRegisterRepository;

class RegisterController extends Controller
{
    protected $repo;

    public function __construct( IUserRegisterRepository $repo ) {
        $this->repo = $repo;
    }

    public function index(){
        return view('auth.register');
    }

    public function store(UserRegisterRequest $request) {

        try {
            $this->repo->store( $request );

            return response()->json(['message' => 'Cadastro realizado com sucesso!'], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], $th->getCode());
        }

    }
}
