<?php

namespace App\Capstone\Profile\Controller;

use App\Facades\Geocoder;
use App\Http\Controllers\Controller;
use App\Http\Requests\BioRequest;
use App\Http\Requests\PostcodeRequest;
use App\Http\Requests\RateRequest;
use App\Http\Requests\SkillsRequest;
use App\Capstone\Profile\Repository\ProfileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function updateBio(BioRequest $request)
    {
        $userId = auth()->id();

        $profile = $this->profileRepo
            ->getProfileById($userId);

        if (!$profile) {
            return responseJson(false, "Profile not found");
        }

        $profile->update([
            "bio" => $request->bio
        ]);

        return response()->json([
            "success" => true,
            "msg" => "Bio was updated"
        ]);
    }

    public function updateRate(RateRequest $request)
    {
        $userId = auth()->id();

        $profile = $this->profileRepo
            ->getProfileById($userId);

        if (!$profile) {
            return responseJson(false, "Profile not found");
        }

        $profile->update([
            "rate" => $request->rate
        ]);

        return responseJson(true, "Rate was updated");
    }

    public function updateSkills(SkillsRequest $request)
    {
        $userId = auth()->id();

        $profile = $this->profileRepo
            ->getProfileById($userId);

        if (!$profile) {
            return responseJson(false, "Profile not found");
        }

        $profile->update([
            "skills" => $request->skills
        ]);

        return responseJson(true, "Skills were updated");
    }

    public function updatePostcode(PostcodeRequest $request)
    {
        $userId = auth()->id();

        $profile = $this->profileRepo
            ->getProfileById($userId);

        if (!$profile) {
            return responseJson(false, "Profile not found");
        }

        $geolocation = Geocoder::geocode($request->postcode);
        if ($geolocation) {
            $profile->update([
              "postcode" => Str::upper($request->postcode)
            ]);
        } else {
            return responseJson(false, "Could not retrieve coordinates");
        }

        $profile->postcode()->create($geolocation);

        return responseJson(true, "Postcode was updated");
    }
}