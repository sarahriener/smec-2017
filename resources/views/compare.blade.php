@extends('layouts.app')

@section('title', 'Compare')

<script>
    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {
        ev.preventDefault();

        if ($('#div2 .filter__items--wrapper')[0]!== undefined) {
            $('.compare .filter__items')[0].append($('#div2 .filter__items--wrapper')[0]);
        }

        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));

    }
</script>


@section('content')

    <div class="compare">
        <div class="compare__header">
            Compare header
        </div>

        @include('layouts.filter')

        <div class="compare__detail">
            <div class="compare__detail__select comparison">
                <div id="div1" class="compare__detail__select--item" >
                    <div class="div1__wrapper">
                        <a href="/country/{{$country->id}}" target="_self">{{$country->name}}</a>
                    </div>
                </div>

                <div id="div2" class="compare__detail__select--item" ondrop="drop(event)" ondragover="allowDrop(event)">
                    <span class="glyphicon glyphicon glyphicon-remove"></span>
                </div>
            </div>

            <div class="compare__detail__data">
                <div class="compare__detail__data--item">

                    @foreach($main_statistic_types as $main_statistic_type)
                        <div class="statistic-menu">
                            <button class="menu">{{$main_statistic_type->name}}</button>

                            <!-- SUBMENU -->
                            @foreach(\App\StatisticType::all()->where('category_id', $main_statistic_type->id) as $sub_statistic_type)
                                <form class="sub-statistic-type">
                                    <input type="hidden" value="{{$country->id}}" name="country_id">
                                    <input type="hidden" value="{{str_replace(" ", "_", $sub_statistic_type->name)}}" name="statistic_type">
                                    <button type="submit" class="menu">
                                       - {{$sub_statistic_type->name}}
                                    </button>
                                </form>
                                <div class="statistic_type" data-statistic-type="{{$sub_statistic_type->name}}" data-country="{{ $country->id }}">

                                </div>
                            @endforeach

                        </div>
                    @endforeach

                </div>

                <div class="compare__detail__data--item">


                </div>
            </div>
        </div>

    </div>
@endsection