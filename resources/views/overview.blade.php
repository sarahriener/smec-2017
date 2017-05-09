@extends('layouts.app')

@section('title', 'Overview')


@section('content')

    <div class="content">
        <div class="content__header">
            <div class="content__header__title">
                <span>Global E-Commerce Facts</span>
            </div>

            <div class="content__header__facts">
                <span class="content__header__facts--fact">78%</span><span class="content__header__facts--fact">108 Mio. $$</span><span class="content__header__facts--fact">98%</span>
            </div>

            <div class="content__header__button">
                <span><button type="button" class="content__header__button--btn">more</button> </span>
            </div>
        </div>

        <div class="content__filter">
            <div class="content__filter__search">
                <label>
                    <span>Choose a Region or</span>
                    <select class="js-example-basic-single form-control content__filter__search--search">
                        <option value="null" title="all">All</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->code }}" title="{{$country->name}}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </label>
            </div>

            <div class="content__filter__tags">
                <button type="button" class="content__filter__tags--tag" data-continent="null">All</button>
                @foreach ($continents as $continent)
                    <button class="content__filter__tags--tag" data-continent="{{$continent->id}}">{{ $continent->name }}</button>
                @endforeach
            </div>
        </div>

        <div class="content__items">

            @foreach ($countries as $country)
                <div class="content__items--item" data-country="{{ $country->code }}" data-continent="{{$country->continent_id}}">
                    <p>{{ $country->name }}</p>
                </div>
            @endforeach
        </div>

    </div>
@endsection