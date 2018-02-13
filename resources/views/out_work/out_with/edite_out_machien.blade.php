@extends('layouts.app')

@section('content')

    <div class="container auth">

        <h1 class="text-center"> تعديل الجهاز الخارج مع الحالة  </h1>
        <div id="big-form" class="well auth-box">
            {!!  Form::model($data,['url'=>'out/machien/update/'.$data->id.'/'.$out_process_id ,'method'=>'post']) !!}
            {{ csrf_field() }}
            <fieldset>

                <!-- Form Name -->
                <legend class="text-center"> التفاصيل </legend>

                <div class="form-group">
                    <label for="name" class=" control-label"> المستخدم </label>
                    {!! Form::text('machien_name',null ,array('class'=>'form-control')) !!}
                    @if ($errors->has('machien_name'))
                        <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">{{ $errors->first('machien_name') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="name" class=" control-label"> العدد </label>
                    {!! Form::number('num',null ,array('class'=>'form-control')) !!}
                    @if ($errors->has('num'))
                        <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">{{ $errors->first('num') }}</strong></span>
                    @endif
                </div>

                <div class="form-group ">
                    <div class="col-lg-8">
                        {!! Form::submit('تعديل',['class'=>'btn btn-success pull-left']) !!}
                    </div>
                </div>
            </fieldset>
            {{Form::close()}}
        </div>
        <div class="clearfix"></div>
    </div>


@endsection
















