<?php

namespace App\User\Repository;

use App\Repository;
use App\User\Model\User;

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
                return true;
            }
        }
        return false;
    }
}