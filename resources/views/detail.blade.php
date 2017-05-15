@extends('layouts.app')

@section('title', 'Detail')


@section('content')

    <div class="detail">
        <div class="detail__header">
            Detail header
        </div>

        @include('layouts.filter')

        <div class="detail__items">

            @foreach ($countries as $country)
                <div class="detail__items--item" data-country="{{ $country->code }}" data-continent="{{$country->continent_id}}">
                    <p>{{ $country->name }}</p>
                </div>
            @endforeach
        </div>


    </div>
@endsection