@extends('layouts.app')

@section('title', 'Drag and Drop')


@section('content')
    <div class="content">
        <div class="comparison">
            <div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
            <div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
        </div>

        <div class="draggables">
            <div id="drag1" class="draggable" draggable="true" ondragstart="drag(event)"></div>
            <div id="drag2" class="draggable" draggable="true" ondragstart="drag(event)"></div>
            <div id="drag3" class="draggable" draggable="true" ondragstart="drag(event)"></div>
            <div id="drag4" class="draggable" draggable="true" ondragstart="drag(event)"></div>
            <div id="drag5" class="draggable" draggable="true" ondragstart="drag(event)"></div>
            <div id="drag6" class="draggable" draggable="true" ondragstart="drag(event)"></div>
            <div id="drag7" class="draggable" draggable="true" ondragstart="drag(event)"></div>
            <div id="drag8" class="draggable" draggable="true" ondragstart="drag(event)"></div>
        </div>
    </div>
@endsection