@extends('layouts.app')

@section('content')

    <div class="container auth">
        <h1 class="text-center"> اضافه عامل  </h1>
        <div id="big-form" class="well auth-box">
            {!! Form::model($employee,['route'=>['employ.update',$employee->id],'method'=>'patch'])!!}
            {{ csrf_field() }}
            <fieldset>

                <!-- Form Name -->
                <legend class="text-center"> البيانات </legend>


                <div class="form-group">
                    <label for="name" class=" control-label"> اسم العامل: </label>
                    {!! Form::text('name',null, ['class'=>'form-control']) !!}
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                {{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="name" class=" control-label"> العنوان: </label>
                    {!! Form::text('address',null, ['class'=>'form-control']) !!}
                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                {{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="name" class=" control-label"> مكان العمل : </label>
                    {!! Form::select('place',['داخلى'=>'داخلى','خارجى'=>'خارجى'],null,
                      ['class'=>'form-control']) !!}
                    @if ($errors->has('place'))
                        <span class="help-block">
                            <strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                {{ $errors->first('place') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password" class=" control-label">رقم التليفون: </label>
                    {!! Form::text('telephone',null, ['class'=>'form-control']) !!}
                    @if ($errors->has('telephone'))
                        <span class="help-block">
                            <strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                {{ $errors->first('telephone') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password" class=" control-label">رقم تليفون اخر: </label>
                    {!! Form::text('mobile',null, ['class'=>'form-control']) !!}
                    @if ($errors->has('mobile'))
                        <span class="help-block">
                            <strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                {{ $errors->first('mobile') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password" class=" control-label">الرقم القومى:  </label>
                    {!! Form::text('number',null,['class'=>'form-control']) !!}
                    @if ($errors->has('number'))
                        <span class="help-block">
                            <strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                {{ $errors->first('number') }}</strong>
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