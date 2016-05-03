<?php

namespace App\User\Controller;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\User\Repository\UserRepository;
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

        if ($this->userRepo->createProfile($userData, $profileData)) {
            return response()->json([
                "success" => true,
                "msg" => "User created"
            ]);
        } else {
            return response()->json([
                "success" => false,
                "msg" => "User not created"
            ]);
        }
    }
}