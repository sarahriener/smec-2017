@extends('layouts.app')

@section('title', 'Entry')

<div class="whoop-header">
    <!-- header img -->
    <span class="whoop-header__intro">Global E-Commerce Facts</span>
    <p>
        Information about all Google Shopping Countries
    </p>
</div>

@section('content')

    <div class="entry">

        <div class="entry__text">
            <span class="entry__text__header">E-Commerce Facts</span>
            <p>
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna
                aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no
                sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                nonumy eirmod tempor invidunt ut laboree
            </p>
        </div>
        
        <div class="entry__data">
            <div class="entry__data__item">
                <span class="entry__data__item__head">€ 919,03 billion</span>
                <span>__{{$aggregatedSales}}__</span>
                <p class="entry__data__item__info">e-commerce sales 2015</p>
            </div>

            <div class="entry__data__item">
                <span class="entry__data__item__head">€ 1256,03 billion</span>
                <span>__{{$aggregatedFutureSales}}__</span>
                <p class="entry__data__item__info">future e-commerce sales 2021</p>
            </div>

            <div class="entry__data__item">
                <span class="entry__data__item__head">{{$salesOfCountry->name}}</span>
                <p class="entry__data__item__info">current sale: {{$salesOfCountry->sales}}</p>
            </div>
        </div>

        <div class="entry__more">
            <p>Curious about our Google-Shopping Countries?</p>
            <span><a href="/overview" class="entry__more__button">Learn more</a> </span>
        </div>


    </div>
@endsection