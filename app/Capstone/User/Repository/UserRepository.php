<?php

namespace App\Capstone\User\Repository;

use App\Capstone\Repository;
use App\Capstone\User\Model\User;

class UserRepository extends Repository
{

    public function __construct(User $profile)
    {
        parent::__construct($profile);
    }

    public function createProfile($userData, $profileData)
    {
        $user = $this->model->create($userData);
        if ($user) {
            if ($user->profile()->create($profileData)) {
                return $user;
            }
        }
        return false;
    }

    public function getUserWithInfo($id)
    {
        return $this->model
          ->with('profile.postcodeInfo')
          ->where('id', $id)
          ->first();
    }
}