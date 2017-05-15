<div class="filter">
    <div class="filter__search">
        <label class="filter__search--label">
            <span class="filter__search--span">Choose a Region or</span>
            <select class="js-example-basic-single form-control filter__search--search">
                <option value="null" title="all">All</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->code }}" title="{{$country->name}}">{{ $country->name }}</option>
                @endforeach
            </select>
        </label>
    </div>

    <div class="filter__tags">
        <button type="button" class="filter__tags--tag" data-continent="null">All</button>
        @foreach ($continents as $continent)
            <button class="filter__tags--tag" data-continent="{{$continent->id}}">{{ $continent->name }}</button>
        @endforeach
    </div>

    <div class="filter__items" id="dragFalse">
        @foreach ($countries as $country)
            <div class="filter__items--item" data-country="{{ $country->code }}" data-continent="{{$country->continent_id}}">
                <p>{{ $country->name }}</p>
            </div>
        @endforeach
    </div>

    <!-- HIDE BY DEFAULT-->
    <div class="filter__items draggables" style="display: none" id="dragTrue">
        @foreach ($countries as $country)
            <div class="filter__items--item draggable" id="{{ $country->code }}" data-country="{{ $country->code }}" data-continent="{{$country->continent_id}}" draggable="true" ondragstart="drag(event)">
                <p>{{ $country->name }}</p>
            </div>
        @endforeach
    </div>

</div>