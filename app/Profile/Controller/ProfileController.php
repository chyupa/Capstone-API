<?php

namespace App\Profile\Controller;

use App\Http\Controllers\Controller;
use App\Profile\Repository\ProfileRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileRepo;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepo = $profileRepository;
    }

    public function createProfile(Request $request)
    {
        dd($request);
    }
}