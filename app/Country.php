<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    public function continent()
    {
        return $this->belongsTo('App\Continent');
    }

    public function statistics()
    {
        return $this->hasMany('App\Statistic');
    }

    public function statistic_types()
    {
        return $this->belongsToMany('App\StatisticType', 'statistics');
    }
}