@extends('layouts.app')

@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading ">
                        <h4>  لوحه تسجيل المستخدم من الشرائح والمسامير لحاله : </h4>
                    </div>
                    <div class="panel-body" style="direction: rtl">
                        {!!  Form::model($used,['url'=>'used/update/'.$used->id ,'method'=>'patch']) !!}
                        <div class="form-group">
                            <label for="name" style="font-size: 17px; margin-right: 132px;"
                                   class=" control-label"> المستخدم </label>

                            <div class="col-lg-4">
                                {!! Form::select('process',array('1'=>'شرائح','2'=>'مسامير'),null
                                ,array('class'=>'form-control','style'=>' margin-right: -182px;')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" style="font-size: 17px; margin-right: 132px;"
                                   class=" control-label">النوع</label>

                            <div class="col-lg-4">
                                {!! Form::text('type',null,
                              ['class'=>'form-control','required','style'=>' margin-right: -182px;']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" style="font-size: 17px; margin-right: 132px;"
                                   class=" control-label">المقاس:  <span>سم</span> </label>

                            <div class="col-lg-4">
                                {!! Form::text('size',null,
                              ['class'=>'form-control','required','style'=>' margin-right: -182px;']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" style="font-size: 17px; margin-right: 132px;"
                                   class=" control-label">العدد </label>
                            <div class="col-lg-4">
                                {!! Form::text('num',null,
                              ['class'=>'form-control','required','style'=>' margin-right: -182px;']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-4">
                                {!! Form::submit('تعديل',
                              ['class'=>'btn btn-primary','style'=>' margin-right: -182px;']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
















