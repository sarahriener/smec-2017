@extends('layouts.app')

@section('title', 'Detail')


@section('content')

    <div class="detail">
        <div class="detail__header">
            Detail header
        </div>

        @include('layouts.filter')

        <div class="menu__left">
            <div>
                <a class="menu" href="#" class="w3-bar-item w3-button">Overview</a>
                <a class="menu" href="#" class="w3-bar-item w3-button">Internet Useres</a>
                <a class="menu" href="#" class="w3-bar-item w3-button">E-Commerce</a>
                <a class="menu" href="#" class="w3-bar-item w3-button">Sales</a>
                <a class="menu" href="#" class="w3-bar-item w3-button">Ad Spend</a>
                <a class="menu" href="#" class="w3-bar-item w3-button">Ausgaben</a>
            </div>
        </div>

        <div class="country">
            <div>
                <div>
                    <h1>{{ $country->name }}
                        <img src="../assets/img/flags" alt="{{ $country->code }}" height="20">
                        <script>
                            function openCompare() {
                                //TODO auf compare View zugreifen
                                window.open("mynewpage.html");
                            }
                        </script>
                        <button onclick="openCompare()" type="button" class="btn btn-default subs-btn">Compare</button>
                    </h1>
                    <!-- TODO wenn Country Img drinnen darauf zugreifen-->

                </div>
                </div>
            </div>
    </div>
@endsection