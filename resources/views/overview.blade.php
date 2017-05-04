@extends('layouts.app')

@section('title', 'Overview')


@section('content')

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


    <script type="text/javascript">
        // TODO require jquery, select2 and bootstrap instead of link and script tags above
        //require('select2-bootstrap-theme');

        // TODO create owne js file
        $(document).ready(function() {
            let $selectBox = $(".js-example-basic-single");
            $selectBox.select2({
                templateResult: formatState,
                templateSelection:formatState
            });

            $selectBox.on("select2:select", function(event) {
                let $valSelected = $(event.currentTarget).find("option:selected").val();

                let $contentItems = $('.content__items--item');

                for(var i=0; i<$contentItems.length; i++) {
                    if($contentItems[i].dataset.value !== $valSelected) {
                        $($contentItems[i]).hide();
                    } else{
                        $($contentItems[i]).show();
                    }
                }
            });
        });

        function formatState (country) {
            if (!country.id) { return country.text; }
            var option = $(
                '<span><img width="30px"  height="auto" src="https://c.tadst.com/gfx/n/fl/128/at.png" class="img-flag" /> ' + country.text + '</span>'
                // TODO add Flag images
                // '<span><img src="vendor/imgs/flags/' + country.id.toLowerCase() + '.png" class="img-flag" /> ' + country.title + '</span>'
            );
            return option;
        }
    </script>

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
                    <button type="button" class="content__filter__tags--tag">{{ $continent->name }}</button>
                @endforeach
            </div>
        </div>

        <div class="content__items">

            <!-- find functions for filter in https://laravel.com/docs/5.1/collections#method-filter -->
            <!-- filter only works if page reloads -->
            @foreach ($countries as $country)
                <div class="content__items--item" data-value="{{ $country->code }}">
                    <p>{{ $country->name }}</p>
                </div>
            @endforeach
        </div>


    </div>
@endsection