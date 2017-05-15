<?php

namespace App\Http\Controllers;
use App\Http\Requests;

// MODELS
use App\Continent;
use App\Country;

class DetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        $continents = Continent::all();

        return view('detail', ['continents' => $continents, 'countries' => $countries]);
    }


    public function show($id)
    {
        $countries = Country::all();
        $continents = Continent::all();

        $country = Country::find($id);
        $continent = $country->continent();

        return view('detail', ['continents' => $continents, 'countries' => $countries,
            'country'=> $country, 'continent'=> $continent]);
    }


}