@extends('layouts.app')

@section('title', 'Compare')


@section('content')

    <div class="compare">
        <div class="compare__header">
            Compare header
        </div>

        @include('layouts.filter')

        <script>


            // TODO ajax anfrage auf statistic details
        </script>


        <div class="compare__detail">
            <div class="compare__detail__select comparison">
                <div id="div1" class="compare__detail__select--item" >
                    <a href="/country/{{$country->id}}" target="_self">{{$country->name}}</a>
                </div>

                <div id="div2" class="compare__detail__select--item">
                   <span>Choose a country to compare!</span>
                </div>
            </div>

            <div class="compare__detail__data">
                <div class="compare__detail__data--item">
                    @foreach(\App\StatisticType::all()->where('category_id', null) as $main_statistic_type)

                        <button class="menu">
                            <a href="/compare/{{$country->id}}/{{ str_replace(" ", "_", $main_statistic_type->name)}}">{{$main_statistic_type->name}}</a>
                        </button>
                    @endforeach
                </div>

                <div class="compare__detail__data--item">


                </div>
            </div>
        </div>

    </div>
@endsection