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

        @include('layouts.filter')

    </div>
@endsection