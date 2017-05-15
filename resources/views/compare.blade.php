@extends('layouts.app')

@section('title', 'Compare')


@section('content')

    <div class="compare">
        <div class="compare__header">
            Compare header
        </div>

        @include('layouts.filter')


        <div class="compare__detail">
            <div class="compare__detail__select comparison">
                <div id="div1" class="compare__detail__select--item" ondrop="drop(event)" ondragover="allowDrop(event)">
                    country 1
                </div>

                <div id="div2" class="compare__detail__select--item" ondrop="drop(event)" ondragover="allowDrop(event)">
                    country 1
                </div>
            </div>

            <div class="compare__detail__data">
                <div class="compare__detail__data--item">
                    data country 1
                </div>

                <div class="compare__detail__data--item">
                    data country 2
                </div>
            </div>
        </div>

    </div>
@endsection