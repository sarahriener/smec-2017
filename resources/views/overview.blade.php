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
                <span>Choose a Region or</span><input type="text" name="search" placeholder="Search.." class="content__filter__search--search">
            </div>

            <div class="content__filter__tags">

                <button type="button" class="content__filter__tags--tag">All</button>
                @foreach ($continents as $continent)
                    <button type="button" class="content__filter__tags--tag">{{ $continent->name }}</button>
                @endforeach

            </div>
        </div>

        <div class="content__items">
            @foreach ($countries as $country)
                <div class="content__items--item">
                    <p>{{ $country->name }}</p>
                </div>
            @endforeach



        </div>


    </div>
@endsection