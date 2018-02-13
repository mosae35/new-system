@extends('layouts.app')

@section('content')

    <div class="container auth">


        <h1 class="text-center">التعديل على الخارج مع الحالة  </h1>
        <div id="big-form" class="well auth-box">
            {!!  Form::model($edit_used,['url'=>'out/edit/'.$edit_used->id ,'method'=>'patch']) !!}
            {{ csrf_field() }}
            <fieldset>

                <!-- Form Name -->
                <legend class="text-center"> التفاصيل </legend>

                <div class="form-group">
                    <label for="name" class=" control-label"> المستخدم </label>
                    {!! Form::select('process',array('1'=>'شرائح','2'=>'مسامير'),null,array('class'=>'form-control')) !!}
                </div>

                <div class="form-group">
                    <label for="name" class=" control-label">النوع</label>
                    {!! Form::text('type',null, ['class'=>'form-control']) !!}
                    @if ($errors->has('type'))
                        <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">{{ $errors->first('type') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="name" class=" control-label">المقاس:  <span>سم</span> </label>
                    {!! Form::number('size',null, ['class'=>'form-control']) !!}
                    @if ($errors->has('size'))
                        <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">{{ $errors->first('size') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="name"class=" control-label">العدد </label>
                    {!! Form::number('num',null,['class'=>'form-control']) !!}
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
















