@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <resto-group :restos="{{ json_encode($restos) }}" />
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <menu-container :items="{{ json_encode($menus) }}" :resto-id={{ $restoId }} />
        </div>
    </div>
</div>
@endsection
