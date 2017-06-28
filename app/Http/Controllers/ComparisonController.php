<?php

namespace App\Http\Controllers;

use App\Http\Requests;

// MODELS
use App\Continent;
use App\Country;
use App\StatisticType;

class ComparisonController extends Controller
{

    public function index()
    {
        $countries = Country::all()->sortBy('name', SORT_ASC);
        $continents = Continent::all()->sortBy('name', SORT_ASC);

        return view('compare', ['continents' => $continents, 'countries' => $countries]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $countries = Country::all()->sortBy('name', SORT_ASC);
        $continents = Continent::all()->sortBy('name', SORT_ASC);

        $country = Country::find($id);
        $continent = $country->continent();

        $main_statistic_types = StatisticType::all()->where('category_id', null)->sortBy('nav_prio', SORT_ASC);

        $data = ['continents' => $continents, 'countries' => $countries,
            'country'=> $country, 'continent'=> $continent, 'main_statistic_types' => $main_statistic_types];

        return view('compare', $data);
    }

}