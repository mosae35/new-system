@extends('layouts.app')

@section('content')

    @include('include.message')
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


        <h1 class="text-center"> تعديل بيانات العضو  </h1>
        <div id="big-form" class="well auth-box">
            {!!  Form::model($data,['route'=>['user.update',$data->id] ,'method'=>'patch']) !!}
            {{ csrf_field() }}
            <fieldset>

                <!-- Form Name -->
                <legend class="text-center">البيانات </legend>

                <div class="form-group">
                    <label for="name" class=" control-label">اسم المستخدم</label>
                        {!! Form::text('name',null,['class'=>'form-control','required']) !!}
                </div>


                <div class="form-group">
                    <label for="name" class=" control-label">الايميل</label>
                        {!! Form::email('email',null,['class'=>'form-control','required']) !!}
                </div>

                <div class="form-group">
                    <label for="password" class=" control-label">الحاله </label>
                        {!! Form::select('admin',['1'=>'مدير','0'=>'مستخدم'],null, ['class'=>'form-control','required']) !!}
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

        <div id="big-form" class="well auth-box">
            {!! Form::open(['url'=>'edit/password/'.$data->id,'method'=>'post']) !!}
            {{ csrf_field() }}
            <fieldset>

                <!-- Form Name -->
                <legend class="text-center">تعديل كلمة السر </legend>

                <div class="form-group">
                    <label for="password" class=" control-label"> كلمه السر السابقه :</label>
                    {!! Form::password('old_password', ['class'=>'form-control','required']) !!}
                </div>

                <div class="form-group">
                    <label for="password" class=" control-label"> كلمه السر الجديده :</label>
                    {!! Form::password('new_password',['class'=>'form-control','required']) !!}
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
