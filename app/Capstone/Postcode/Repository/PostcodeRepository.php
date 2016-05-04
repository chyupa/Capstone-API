<?php

namespace App\Capstone\Postcode\Repository;

use App\Capstone\Postcode\Model\Postcode;
use App\Capstone\Repository;

class PostcodeRepository extends Repository
{
    public function __construct(Postcode $postcode)
    {
        parent::__construct($postcode);
    }

    public function getProfilesByPostcode($postcode)
    {
        return $this->model
          ->with('profile')
          ->where("postcode", 'like', $postcode)
          ->paginate(1)
          ->get();
    }
}