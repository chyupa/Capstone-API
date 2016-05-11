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

    public function getAllProfiles()
    {
        return $this->model
          ->with('postcodeInfo')
          ->paginate(10);
    }

    public function getProfilesByPostcode($postcode)
    {
        return $this->model
          ->with('postcodeInfo')
          ->where('postcode', 'like', '%'.$postcode.'%')
          ->paginate(1);
    }

    public function getProfileInfo($userId)
    {
        return $this->model
          ->with('user')
          ->with('postcodeInfo')
          ->where('user_id', $userId)
          ->first();
    }
}