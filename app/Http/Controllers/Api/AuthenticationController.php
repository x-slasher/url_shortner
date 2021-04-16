<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Repositories\User\UserRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    use ResponseTrait;
    private $repository;
    public function __construct(UserRepository $repository)
    {
        $this->repository =  $repository;
    }

    public function register(UserRegisterRequest $request){
        $this->repository->create($request->all());
        return $this->withSuccess('User Created Successfully');
    }

    public function login(UserLoginRequest $request) {
        $accessToken = $this->generateToken($request->all());
        if($accessToken != false){
            return $this->withData('User Login Successfully',$accessToken);
        }else{
            return $this->withError('Invalid Credential',401);
        }
    }

    public function generateToken($request) {
        if(auth()->attempt($request)){
            return auth()->user()->createToken('test')->accessToken;
        }else {
            return false;
        }
    }

    public function profile(){
        $user = $this->repository->findUser();
        return $this->withData('User Found Successfully',$user);
    }

    public function logout(Request $request){
        $this->repository->logout($request);
        return $this->withSuccess('logout successfully');
    }
}
