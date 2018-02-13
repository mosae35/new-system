@extends('layouts.app')

@section('content')
    <div class="container auth">

        <div class="row">
            @if(count($errors) > 0)
                <div class=" col-lg-6 erorrs">
                    <ul>
                        @foreach($errors->all() as $errors)
                            <li>  {{ $errors }} </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>


        <h1 class="text-center"> تعديل بيانات الجهاز  </h1>
        <div id="big-form" class="well auth-box">
            {!! Form::model($data,['route'=>['requirement.update',$data->id],'method'=>'patch'])!!}
            {{ csrf_field() }}
            <fieldset>

                <!-- Form Name -->
                <legend class="text-center"> تفاصيل الحالة </legend>

                <div class="form-group">
                    <label for="name" class=" control-label">اسم ألألة :</label>
                    {!! Form::text('name',null,  ['class'=>'form-control','required']) !!}
                </div>
                <div class="form-group">
                    <label for="name" class=" control-label">العدد :</label>
                    {!! Form::number('num',null,['class'=>'form-control','required']) !!}
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


