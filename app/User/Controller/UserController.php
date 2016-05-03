<?php

namespace App\User\Controller;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\User\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    public function createUser(CreateUserRequest $request)
    {
        $userData = [
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ];

        $profileData = [
            "name" => $request->name
        ];

        $user = $this->userRepo->createProfile($userData, $profileData);
        if ($user) {
            if (Auth::attempt([
                "email" => $request->email,
                "password" => $request->password
            ])
            ) {
                return response()->json([
                    "success" => true,
                    "msg" => "User created and logged in"
                ]);
            } else {
                return response()->json([
                    "success" => true,
                    "msg" => "User created but not logged in"
                ]);
            }
        } else {
            return response()->json([
                "success" => false,
                "msg" => "User not created"
            ]);
        }
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->all())) {
            return response()->json([
                "success" => true,
                "msg" => "User logged in"
            ]);
        } else {
            return response()->json([
                "success" => false,
                "msg" => "Invalid email or password"
            ]);
        }
    }

    public function logout()
    {
        dd(auth()->user());
        Auth::logout();

        return response()->json([
            "success" => true,
            "msg" => "User logged out"
        ]);
    }
}