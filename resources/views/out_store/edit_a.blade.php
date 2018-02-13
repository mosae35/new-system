@extends('layouts.app')

@section('content')
    <div class="container auth">
        <div id="big-form" class="well auth-box" style="margin-left: 388px;border-radius: 10px;margin-top: 21px; width: 426px;">
            {!! Form::model($sort_a ,['route'=>['out_store.update',$sort_a->id],'method' => 'patch']) !!}
            @include('store.form_a',['edit_a'=>'5'])
            {!! Form::close() !!}
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
