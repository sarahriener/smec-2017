@extends('layouts.app')

@section('title', 'Overview')

<div class="whoop-header">
    <!-- header img -->
    <span class="whoop-header__intro">Google Shopping Countries</span>
    <p>
        Learn more about e-commerce in different regions
    </p>
</div>

@section('content')
    <div class="overview">

        <div class="nav__top">
            <div class="nav__top__breadcrumbs">
                <!-- TODO breadcrumb Klasse bennenen auch in CSS -->
                <ol class="nav__top__breadcrumb">
                    <li><a href="/overview">Google Shopping Compendium</a></li>
                </ol>
            </div>
        </div>

        @include('layouts.filter')

    </div>
@endsection