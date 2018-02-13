@extends('layouts.app')

@section('content')

    <div class="container auth">
        <div id="big-form" class="well auth-box" style="margin-left: 388px;border-radius: 10px;margin-top: 21px; width: 426px;">
            {!! Form::model($edit_sort_c ,['url'=>['out_sort_c/update',$edit_sort_c->id],'method' => 'patch']) !!}
            @include('store.form_a',['cic'=>'1'])
            {!! Form::close() !!}
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
