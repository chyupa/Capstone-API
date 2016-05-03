<?php

namespace App\Postcode\Model;

use Illuminate\Database\Eloquent\Model;

class Postcode extends Model
{
    protected $table = "postcodes";

    protected $fillable = ['profile_id', 'lat', 'lon'];

    public function profile()
    {
        return $this->belongsTo('App\Profile\Model\Profile');
    }
}