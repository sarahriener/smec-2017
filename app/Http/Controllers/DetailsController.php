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
    public function show($id, $type = 'E-Commerce_Users')
    {
        $countries = Country::all();
        $continents = Continent::all();

        $country = Country::find($id);
        $continent = $country->continent();

        $data = ['continents' => $continents, 'countries' => $countries,
            'country'=> $country, 'continent'=> $continent];

        $statistics = $this->getStatisticDetailsByType($id, $type);
        $data['statistic_type'] = $statistics['statistic_type'];
        $data['statistic_details'] = $statistics['statistic_details'];

        return view('detail', $data);
    }

    public function getStatisticDetailsByType($country_id, $type){

        $country = Country::find($country_id);

        $type= str_replace("_", " ", $type);
        $statistic_type  = $country->statistic_types->where('name', $type)->first();
        $statistic = $country->statistics->where('statistic_type_id', $statistic_type->id)->first();
        $statistic_details = $statistic->statistic_details;

        $data = array();
        $data['statistic_type'] = $statistic_type; // just one type
        $data['statistic_details'] = $statistic_details; // several details for each type (per year)

        return $data;
    }



    public function getStatisticDetails(){

        $country_id = $_GET['country_id'];
        $country = Country::find($country_id);

        $type = $_GET['statistic_type'];
        $type= str_replace("_", " ", $type);

        $main_statistic_type  = $country->statistic_types->where('name', $type)->first();

        $data = array();

        // search for statistic subtypes
        $sub_statistic_types = $country->statistic_types->where('category_id', $main_statistic_type->id);
        foreach($sub_statistic_types as $statistic_type){
            $statistic = $country->statistics->where('statistic_type_id', $statistic_type->id)->first();
            $statistic_details = $statistic->statistic_details;

            $statistic_detail = array();
            $statistic_detail['statistic_type'] = $statistic_type;
            $statistic_detail['statistic_details'] = $statistic_details;
            array_push($data, $statistic_detail);
        }

        return $data;
    }


}