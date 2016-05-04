<?php

namespace App\Capstone\Profile\Repository;

use App\Capstone\Profile\Model\Profile;
use App\Capstone\Repository;

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