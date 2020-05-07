@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <resto-group :restos="{{ json_encode($restos) }}" />
        </div>
    </div>
</div>
@endsection
