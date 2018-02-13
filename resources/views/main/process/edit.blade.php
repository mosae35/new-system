@extends('layouts.app')

@section('content')
    <div class="container auth">

        <h1 class="text-center"> التعديل على الحالة  </h1>
        <div id="big-form" class="well auth-box">
            {!! Form::model($data,['route'=>['process.update',$data->id],'method'=>'patch'])!!}
            {{ csrf_field() }}
            <fieldset>

                <!-- Form Name -->
                <legend class="text-center"> تفاصيل الحالة </legend>


                <div class="form-group">
                    <label for="name" class=" control-label">اسم الدكتور :</label>
                    {!! Form::text('doctor',null, ['class'=>'form-control','placeholder'=>'الدكتور']) !!}
                    @if ($errors->has('doctor'))
                        <span class="help-block">
                            <strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">{{ $errors->first('doctor') }}</strong>
                        </span>
                    @endif
                </div>



                <div class="form-group">
                    <label for="name"
                           class=" control-label">اسم الحاله :</label>
                    {!! Form::text('name',null,
                  ['class'=>'form-control','placeholder'=>'الحاله']) !!}
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group">
                    <label for="password"
                           class=" control-label">نوع الحاله :</label>
                    {!! Form::text('type',null,['class'=>'form-control','placeholder'=>'النوع']) !!}
                    @if ($errors->has('type'))
                        <span class="help-block">
                            <strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">{{ $errors->first('type') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group">
                    <label  class=" control-label">اسم الفنى  </label>
                    {!! Form::text('client',null, ['class'=>'form-control','placeholder'=>'الفنى']) !!}
                    @if ($errors->has('client'))
                        <span class="help-block">
                            <strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">{{ $errors->first('client') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group">
                    <label for="password"  class=" control-label">المكان  </label>
                    {!! Form::text('place',null,
                    ['class'=>'form-control','placeholder'=>'المنطقة']) !!}
                    @if ($errors->has('place'))
                        <span class="help-block">
                            <strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">{{ $errors->first('place') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group">
                    <label for="password"  class=" control-label">المبلغ المدفوع  </label>
                    {!! Form::number('cash',null, ['class'=>'form-control','placeholder'=>'الدفوع']) !!}
                    @if ($errors->has('cash'))
                        <span class="help-block">
                            <strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">{{ $errors->first('cash') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group">
                    <label for="password" class=" control-label"> المتبقى من المبلغ  </label>
                    {!! Form::number('not_cash',null,['class'=>'form-control','placeholder'=>'المتبقى']) !!}
                    @if ($errors->has('not_cash'))
                        <span class="help-block">
                            <strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">{{ $errors->first('not_cash') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="name" class=" control-label">التاريخ :</label>
                    {!! Form::date('created_at',null, ['class'=>'form-control']) !!}
                    @if ($errors->has('created_at'))
                        <span class="help-block">
                            <strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">{{ $errors->first('created_at') }}</strong>
                        </span>
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