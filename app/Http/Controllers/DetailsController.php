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


    /**
     * @param $id
     * @param null $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id, $type = null)
    {
        $countries = Country::all();
        $continents = Continent::all();

        $country = Country::find($id);
        $continent = $country->continent();

        $data = ['continents' => $continents, 'countries' => $countries,
            'country'=> $country, 'continent'=> $continent];

        $type = "Population";

        if($type){
            $data = $this->getStatisticDetailsByType($country, $type, $data);
        }
        return view('detail', $data);
    }

    function getStatisticDetailsByType($country, $type, $data){

        $statistic_type  = $country->statistic_types->where('name', $type)->first();

        $statistic = $country->statistics->where('statistic_type_id', $statistic_type->id)->first();

        $statistic_detail = $statistic->statistic_details;

        $data['statistic_type'] = $statistic_type;
        $data['statistic_detail'] = $statistic_detail;

        return $data;

    }



}