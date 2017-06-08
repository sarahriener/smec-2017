<?php

namespace App\Http\Controllers;
use App\Http\Requests;

// MODELS
use App\Continent;
use App\Country;
use App\StatisticType;

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


    /**
     * @param $id
     * @param null $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $countries = Country::all();
        $continents = Continent::all();

        $country = Country::find($id);
        $continent = $country->continent();

        $main_statistic_types = StatisticType::all()->where('category_id', null);

        $data = ['continents' => $continents, 'countries' => $countries,
            'country'=> $country, 'continent'=> $continent, 'main_statistic_types' => $main_statistic_types];

        return view('detail', $data);
    }

    public function getStatisticDetails(){

        $country_id = $_GET['country_id'];
        $country = Country::find($country_id);

        $type = $_GET['statistic_type'];
        $type= str_replace("_", " ", $type);

        $statistic_type  = $country->statistic_types->where('name', $type)->first();
        $statistic = $country->statistics->where('statistic_type_id', $statistic_type->id)->first();
        $statistic_details = $statistic->statistic_details;

        $data = array();
        $data['country'] = $country;
        $data['statistic_type'] = $statistic_type; // just one type
        $data['statistic_details'] = $statistic_details; // several details for each type (per year)

        return $data;
    }


}