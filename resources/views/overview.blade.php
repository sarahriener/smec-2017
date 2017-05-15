@extends('layouts.app')

@section('title', 'Overview')


@section('content')

    <div class="overview">
        <div class="overview__header">
            <div class="overview__header__title">
                <span>Global E-Commerce Facts</span>
            </div>

            <div class="overview__header__facts">
                <span class="overview__header__facts--fact">78%</span><span class="overview__header__facts--fact">108 Mio. $$</span><span class="overview__header__facts--fact">98%</span>
            </div>

            <div class="overview__header__button">
                <span><button type="button" class="overview__header__button--btn">more</button> </span>
            </div>
        </div>

        @include('layouts.filter')

    </div>
@endsection