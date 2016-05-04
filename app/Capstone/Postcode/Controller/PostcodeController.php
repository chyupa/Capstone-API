<?php

namespace App\Capstone\Postcode\Controller;

use App\Capstone\Postcode\Repository\PostcodeRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostcodeController extends Controller
{
    protected $postcodeRepo;

    public function __construct(PostcodeRepository $postcodeRepository)
    {
        $this->postcodeRepo = $postcodeRepository;
    }

    public function getProfilesByPostcode(Request $request)
    {
        return response()->json([
            "success" => true,
            "data" => $this->postcodeRepo->getProfilesByPostcode($request->postcode)
        ]);
    }
}