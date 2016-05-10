<?php

namespace App\Capstone\User\Controller;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Capstone\User\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
          "email" => "required|email|unique:users",
          "password" => "required|min:6",
          "name" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

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
                  "id" => $user->id,
                ]);
            } else {
                return response()->json([
                  "success" => true,
                  "id" => $user->id,
                ]);
            }
        } else {
            return response()->json([
                "success" => false,
                "msg" => "User not created"
            ]);
        }
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->all())) {
            $user = $this->userRepo
              ->getUserWithInfo(auth()->id());

            return response()->json([
                "success" => true,
                "msg" => "User logged in",
                "userId" => auth()->id(),
                "user" => $user
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
//        dd(auth()->user());
        Auth::logout();

        return response()->json([
            "success" => true,
            "msg" => "User logged out"
        ]);
    }
}