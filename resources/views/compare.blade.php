@extends('layouts.app')

@section('title', 'Compare')

@section('content')

        @include('layouts.header')
        @include('layouts.filter')

        <div class="compare__detail">
            <div class="compare__detail__select comparison">
                <div id="div1" class="compare__detail__select__item" >
                    <div class="div1__wrapper">
                        <a href="/country/{{$country->id}}" target="_self">{{$country->name}}</a>
                    </div>
                </div>

                <div id="div2" class="compare__detail__select__item">
                </div>
            </div>

            <div class="compare__detail__data" >
                <div class="compare__detail__data__item" id="data-div1">

                    @include('layouts.statistic_menu')

                </div>

                <div class="compare__detail__data__item" id="data-div2">

                    @include('layouts.statistic_menu')

                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript" src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>


@endsection
