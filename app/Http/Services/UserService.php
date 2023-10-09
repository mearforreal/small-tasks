<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;

use Illuminate\Support\Facades\Hash;



class UserService
{



    public function register($fields)
    {

        $userRole = Role::where('title', Role::ROLE_USER)->first();

        $user = new User();
        $user->name = $fields['name'];
        $user->email = $fields['email'];
        $user->password = bcrypt($fields['password']);
        $user->save();

        $user->roles->attach($userRole);

        $token = $user->createToken('myapptokenkey')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function login($fields)
    {


        // check email;
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return [
                'status' => '401'
            ];
        }

        $token = $user->createToken('myapptokenkey')->plainTextToken;


        return  [
            'status' => '200',
            'user' => $user,
            'token' => $token
        ];
    }


    // public function logout()
    // {
    //     auth()->user()->tokens()->delete();

    //     return [
    //         'message' => 'logged out'
    //     ];
    // }
}
