<?php

namespace App\Http\Controllers;

use App\Http\Requests;

// MODELS
use App\Continent;
use App\Country;

class ComparisonController extends Controller
{

    public function index()
    {
        $countries = Country::all();
        $continents = Continent::all();

        return view('compare', ['continents' => $continents, 'countries' => $countries]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $countries = Country::all();
        $continents = Continent::all();

        $country = Country::find($id);
        $continent = $country->continent();

        $data = ['continents' => $continents, 'countries' => $countries,
            'country'=> $country, 'continent'=> $continent];

        return view('compare', $data);
    }

}