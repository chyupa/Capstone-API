<?php

namespace App\User\Repository;

use App\Repository;
use App\User\Model\User;
use Illuminate\Http\Request;

class UserRepository extends Repository
{

    public function __construct(User $profile)
    {
        parent::__construct($profile);
    }

    public function createUser(Request $request)
    {
        dd($request->all());
    }
}