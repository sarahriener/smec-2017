@extends('layouts.app')

@section('title', 'Entry')

<div class="whoop-header">
    <!-- header img -->
    <span class="whoop-header__intro">Global E-commerce Facts</span>
    <p>
        Information about all Google Shopping Countries
    </p>
</div>

@section('content')

    <div class="entry">

        <div class="entry__text">
            <h4 class="entry__text__header">E-commerce Facts</h4>
            <p>
                With the following data, we want to answer the first important questions about E-commerce. We collected
                important facts such as the number of inhabitants,
                the turnover, the web usage according to the device, but also the advertising expenditures online,
                spatially distributed by country and prepared them visually appealing.
                The focus is on the use of the initial information for people who need start-up assistance in
                E-commerce.
            </p>
        </div>

        <div class="entry__data">
            <div class="entry__data__item">
                <div>
                    <img class="entry__data__item__img" src="/img/icons/coins_orange.png">
                </div>

                <p class="entry__data__item__info">Worldwide E-commerce Sales 2016</p>
                <span class="entry__data__item__head">{{$type}} {{$aggregatedSales}}</span>
            </div>

            <div class="entry__data__item">
                <div>
                    <img class="entry__data__item__img" src="/img/icons/basket_orange.png">
                </div>

                <p class="entry__data__item__info">Predicted Worldwide E-commerce Sales 2021</p>
                <span class="entry__data__item__head">{{$type}} {{$aggregatedFutureSales}}</span>
            </div>

            <div class="entry__data__item">
                <div>
                    <img class="entry__data__item__img" src="/img/icons/globe_orange.png">
                </div>

                <p class="entry__data__item__info">Random Google Shopping Country</p>

                <span class="entry__data__item__head">{{$salesOfCountry->name}}</span>
                @if (strcmp($salesOfCountry->sales, "") === 0)
                    <p class="entry__data__item__info">
                        No Sales of 2016 Available
                    </p>
                @else
                    <p class="entry__data__item__info">Sale 2016</p>
                    <p class="entry__data__item__head">{{$type}} {{$salesOfCountry->sales}}</p>
                @endif

            </div>
        </div>

        <div class="entry__more">
            <p>Curious about our Google Shopping Countries?</p>
            <span><a href="/overview" class="entry__more__button">Learn more</a> </span>
        </div>


    </div>
@endsection