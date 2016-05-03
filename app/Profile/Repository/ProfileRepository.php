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

    public function getProfileById($userId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->first();
    }
}