<?php

namespace App\User\Controller;

use App\Http\Controllers\Controller;
use App\User\Repository\UserRepository;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }
}