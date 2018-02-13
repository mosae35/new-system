@extends('layouts.app')

@section('content')
    <div class="container auth">
        <div id="big-form" class="well auth-box" style="margin-left: 388px;border-radius: 10px;margin-top: 21px; width: 426px;">

            {!! Form::open(['route'=>'out_store.store']) !!}
            @include('store.form_a',['sort_a_n'=>'1'])
            {!! Form::close() !!}
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
