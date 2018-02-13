@extends('layouts.app')

@section('content')
    <div class="container auth">

        <div id="big-form" class="well auth-box" style="margin-left: 388px;border-radius: 10px;margin-top: 21px; width: 426px;">
            {!! Form::model($sort_c ,['url'=>['update/total_c/'.$sort_c->id],'method' => 'post']) !!}
            {{ csrf_field() }}
            <fieldset>

                <!-- Form Name -->
                <legend class="text-center">تعديل المجموع الكلى للمسامير ذات القطر </legend>

                <div class="form-group">
                    <label for="name" class=" control-label">النوع :</label>
                    {!! Form::text('sort',null, ['class'=>'form-control']) !!}
                    @if ($errors->has('sort'))
                        <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                {{ $errors->first('sort') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="name" class=" control-label">العدد :</label>
                    {!! Form::number('num',null, ['class'=>'form-control']) !!}
                    @if ($errors->has('num'))
                        <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                {{ $errors->first('num') }}</strong>
                        </span>
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
