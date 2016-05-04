<?php

namespace App\Capstone\GoogleGeocoder;

class GoogleGeocoder
{
    private $apiKey;
    private $apiUrl;

    private $requestUri;

    public function __construct()
    {
        $this->apiKey = env("GOOGLE_MAPS_GEOCODING", false);
        $this->apiUrl = "https://maps.googleapis.com/maps/api/geocode/json";
    }

    protected function buildQuery($postcode)
    {
        $this->requestUri = sprintf("%s?address=%s&country=%s&sensor=false&key=%s", $this->apiUrl, urlencode($postcode), "gb", $this->apiKey);
    }

    public function geocode($postcode)
    {
        $this->buildQuery($postcode);
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->requestUri);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $geolocation = curl_exec($ch);

            $response = json_decode($geolocation);
            if ($response->results[0]->geometry->location->lat && $response->results[0]->geometry->location->lng) {
                return [
                    "lat" => $response->results[0]->geometry->location->lat,
                    "lon" => $response->results[0]->geometry->location->lng,
                ];
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}