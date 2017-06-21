@extends('layouts.app')

@section('title', 'Overview')

<div class="whoop-header">
    <span class="whoop-header__intro">Google Shopping Countries</span>
    <p>
        Learn more about e-commerce in different regions
    </p>
</div>

@section('content')
    <div class="overview">

        <div class="nav__top">
            <div class="nav__top__breadcrumbs">
                <ol class="nav__top__breadcrumb">
                    <li><a href="/">Google Shopping Compendium</a></li> /
                    <li class="active">Overview</li>
                </ol>
            </div>
        </div>

        @include('layouts.filter')

    </div>
@endsection