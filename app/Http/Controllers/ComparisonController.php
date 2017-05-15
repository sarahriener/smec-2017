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

}