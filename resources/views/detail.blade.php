@extends('layouts.app')

@section('title', 'Detail')


@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <div class="detail">
        @include('layouts.header')


        <div class="nav__top">
            <a href="/overview" class="nav__top__back"><span class="glyphicon glyphicon-menu-left"></span>Back to overview</a>

            <div class="nav__top__breadcrumbs">
                <!-- TODO breadcrumb Klasse bennenen auch in CSS -->
                <ol class="nav__top__breadcrumb">
                    <li><a href="/">Google Shopping Compendium</a></li> /
                    <li><a href="/overview">Overview</a></li> /
                    <li class="active"><a href="/country/{{ $country->id }}">{{ $country->name }}</a></li>
                </ol>
            </div>
        </div>


        @include('layouts.filter')

        <div class="menu__left">
            @include('layouts.statistic_menu')
        </div>

        <div class="country">

            <h1>{{ $country->name }}
                <a class="compareBtn" href="/compare/{{ $country->id }}" target="_self" class="btn btn-default subs-btn">Compare</a>
            </h1>

            <div class="detail-content">
                <p class="intro-text"> HIER BRAUCHEN WIR UNBEDINGT NOCH EINEN INTRO TEXT PRO LAND </p>
                <div class="statistic-data detail-data" data-country="{{ $country->id }}">

                <p>Select a statistic type.</p>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>


@endsection