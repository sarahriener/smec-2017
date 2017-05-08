<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
    /**
     * Get the countries per continent.
     */
    public function countries()
    {
        return $this->hasMany('App\Country');
    }
}
