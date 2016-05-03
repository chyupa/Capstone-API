<?php

namespace App\Profile\Repository;

use App\Profile\Model\Profile;
use App\Repository;
use Illuminate\Http\Request;

class ProfileRepository extends Repository
{

    public function __construct(Profile $profile)
    {
        parent::__construct($profile);
    }

    public function createProfile(Request $request)
    {
        dd($request->all());
    }
}