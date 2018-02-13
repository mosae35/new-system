@extends('layouts.app')

@section('content')

    <div class="container auth">
        <div id="big-form" class="well auth-box" style="margin-left: 388px;border-radius: 10px;margin-top: 21px; width: 426px;">

            {!! Form::open(['url'=>'out_add/sort_b','method'=>'post']) !!}
            @include('store.form_a',['sort_b'=>'2'])
            {!! Form::close() !!}
        </div>
        <div class="clearfix"></div>
    </div>

@endsection