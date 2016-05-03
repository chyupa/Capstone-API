<?php

namespace App\Profile\Model;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = ['user_id', 'bio', 'rate', 'skills', 'postcode'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}