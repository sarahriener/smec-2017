@extends('layouts.app')

@section('title', 'Detail')


@section('detail')


<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<script type="text/javascript">
</script>

<!-- TODO INSERT HEADER HERE -->

<div class="content">
    <div class="content__header">
        <div class="content__title">
            <span>{{ $country->name }}</span>
            <!-- TODO wenn Country Img drinnen darauf zugreifen-->
            <img src="../assets/img/flags" alt="{{ $country->code }}" height="20">
            <script>
                function openCompare() {
                    //TODO auf compare View zugreifen
                    window.open("mynewpage.html");
                }
            </script>
            <button onclick="openCompare()" type="button" class="btn btn-default subs-btn">Compare</button>
        </div>
        <div class="wrapper">
            <div class="wrapper__left">
                <div class="panel-group" id="accordion">
                    @foreach($categories as $category)
                    <div class="panel panel-default">
                        @if($category->id == $attribute->category_id)
                        <a data-toggle="collapse" class="panelColor on" data-parent="#accordion"
                           href="#{{ $category->dropdown_id }}">
                            @else
                            <a data-toggle="collapse" class="panelColor" data-parent="#accordion"
                               href="#{{ $category->dropdown_id }}">
                                @endif

                                <div id="{{ $category->panel_heading_id }}" class="panel-heading">
                                    <h4 class="panel-title">
                                        <i class="fa {{ $category->icon }}" aria-hidden="true"></i>{{
                                        $category->category_name }}
                                    </h4>
                                </div>
                            </a>
                            <!-- aktuelles MenÃ§Â«Â¯ ausklappen -->
                            @if($category->id == $attribute->category_id)
                            <div id="{{ $category->dropdown_id }}" class="panel-collapse collapse in">

                                @else
                                <div id="{{ $category->dropdown_id }}" class="panel-collapse collapse">
                                    @endif

                                    <div class="panel-body ">
                                        <table class="table">
                                            @foreach($category->attributes as $categoryAttribute)
                                            <tr>
                                                <td>
                                                    @if($attribute->id == $categoryAttribute->id)
                                                    <a href="{{ $categoryAttribute->url }}" class="selected">{{
                                                        $categoryAttribute->attribute_name }}</a>
                                                    @else
                                                    <a href="{{ $categoryAttribute->url }}">{{
                                                        $categoryAttribute->attribute_name }}</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </div>
                </div>
                <div class="wrapper__right"></div>
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
                        @foreach ($countries as $country)
                        <option value="{{ $country->code }}" title="{{$country->name}}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </label>
            </div>

            <div class="content__filter__tags">
                <button type="button" class="content__filter__tags--tag">All</button>
                @foreach ($continents as $continent)
                <button class="content__filter__tags--tag">{{ $continent->name }}</button>
                @endforeach
            </div>
        </div>

        <div class="content__items">

            <!-- find functions for filter in https://laravel.com/docs/5.1/collections#method-filter -->
            <!-- filter only works if page reloads -->
            @foreach ($countries as $country)
            <div class="content__items--item" data-value="{{ $country->code }}">
                <p>{{ $country->name }}</p>
                <script type="text/javascript">

                    function myFunction() {
                        window.open("https://www.w3schools.com");
                    }

                </script>
            </div>
            @endforeach
        </div>

    </div>
    @endsection