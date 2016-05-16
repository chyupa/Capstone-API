<?php

namespace App\Capstone\Profile\Controller;

use App\Facades\Geocoder;
use App\Http\Controllers\Controller;
use App\Http\Requests\RateRequest;
use App\Capstone\Profile\Repository\ProfileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    protected $profileRepo;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepo = $profileRepository;
    }

    public function updateImage(Request $request) {

        if ($request->hasFile('image')) {
            $file = $request->file('image');
        } else {
            return responseJson(false, "Image not found");
        }

        if ($file->isValid()) {

            $directory = public_path("images/$request->userId");

            $filename = Str::random(12) . "." . $file->getClientOriginalExtension();

            $file->move($directory, $filename);

            $profile = $this->profileRepo
              ->getProfileById($request->userId);

            if (!$profile) {
                return responseJson(false, "Profile not found");
            }

            $profile->update([
                "profile_image" => asset("images/$request->userId/$filename")
            ]);

            return response()->json([
              "success" => true,
              "msg" => "Profile Image was updated"
            ]);
        }
    }

    public function updateBio(Request $request)
    {
        $userId = $request->userId;

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

    public function updateRate(Request $request)
    {
        $userId = $request->userId;

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

    public function updateSkills(Request $request)
    {
        $userId = $request->userId;

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

    public function updatePostcode(Request $request)
    {
        $userId = $request->userId;

        $profile = $this->profileRepo
            ->getProfileById($userId);

        if (!$profile) {
            return responseJson(false, "Profile not found");
        }

        $geolocation = Geocoder::geocode($request->postcode);
        if ($geolocation) {
            $profile->update([
              "postcode" => Str::upper(str_replace(" ", "", $request->postcode))
            ]);
        } else {
            return responseJson(false, "Could not retrieve coordinates");
        }

        $profile->postcodeInfo()->create($geolocation);

        return responseJson(true, "Postcode was updated");
    }

    public function getAllProfiles()
    {
        return response()->json(
            $this->profileRepo->getAllProfiles()
        );
    }

    public function getProfilesByPostcode(Request $request)
    {
        return response()->json(
          $this->profileRepo->getProfilesByPostcode($request->postcode)
        );
    }

    public function getProfileByUserId(Request $request)
    {
        return response()->json(
          $this->profileRepo->getProfileInfo($request->userId)
        );
    }
}