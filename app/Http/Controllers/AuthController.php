<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Services\UserService;

class AuthController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request  $request)
    {

        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $response =  $this->userService->register($fields);

        return response($response, 201);
    }

    public function login(Request  $request)
    {
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        $response =  $this->userService->login($fields);

        if ($response['status'] == '200') {
            return response($response, 200);
        } else {
            return response($response, 401);
        }
    }


    // public function logout(Request $request)
    // {
    //     $userService = new UserService($request);
    //     return $userService->logout();
    // }
}
