@extends('layouts.app')

@section('content')
    <div class="container auth">

        @include('include.message')
        <div id="big-form" class="well auth-box" style="margin-left: 388px;border-radius: 10px;margin-top: 21px; width: 426px;">
            {!!  Form::model($data,['url'=>'machien/update/'.$data->id .'/'.$process_id,'method'=>'post']) !!}
            {{ csrf_field() }}
            <fieldset>

                <!-- Form Name -->
                <legend class="text-center"> تعديل الجهاز الخارج مع الحالة </legend>

                <div class="form-group">
                    <label for="name" class=" control-label"> المستخدم </label>
                    {!! Form::text('machien_name',null ,array('class'=>'form-control')) !!}
                    @if ($errors->has('machien_name'))
                        <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">{{ $errors->first('machien_name') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="name" class=" control-label"> العدد </label>
                    {!! Form::number('num',null,array('class'=>'form-control')) !!}
                    @if ($errors->has('num'))
                        <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">{{ $errors->first('num') }}</strong></span>
                    @endif
                </div>

                <div class="form-group ">
                    <div class="col-lg-8">
                        {!! Form::submit('تسجيل',['class'=>'btn btn-success pull-left']) !!}
                    </div>
                </div>
            </fieldset>
            {{Form::close()}}
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
















