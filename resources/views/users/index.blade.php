@extends('layouts.app')

@section('content')

    <div class="container ">
        <div class="row">
            @include('include.message')
            <div class="col-lg-9 auth">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <div class="panel-heading ">
                        <h4 class="text-center"
                            style="background: #40a01a24; padding: 10px;border-radius: 5px;color: black;"> المدير</h4>
                    </div>
                    <div class="panel-body">
                    <table class=" table_process table" >
                        <tr style="color: white;">
                            <th style=" text-align: center;">اسم المستخدم</th>
                            <th style=" text-align: center;">الايميل</th>
                            <th style=" text-align: center;">المدير </th>
                            <th style=" text-align: center;">تاريخ الاضافه</th>
                            <th style=" text-align: center;">تعديل</th>
                            <th style=" text-align: center;">حذف</th>
                        </tr>
                        @foreach($data as $processs)
                            <tr style="color: black;">
                                <td>{{$processs->name}}</td>
                                <td>{{$processs->email}}</td>
                                <td>{{$processs->admin}} </td>
                                <td>{{$processs->created_at}}</td>
                                <td>
                                    {!! Form::open() !!}
                                    <a class="btn btn-primary btn-sm" href="{{url('user/'.$processs->id.'/edit')}}">تعديل</a>
                                    {!! Form::close() !!}
                                </td>
                                <td>
                                    {!! Form::open(['method'=>'DELETE' ,'route'=>['user.destroy',$processs->id]]) !!}
                                    {!! Form::submit('حذف',['class'=>'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}</td>
                            </tr>
                        @endforeach
                    </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 auth">
                <h1 class="text-center">التحكم الرئيسى</h1>
                <div id="big-form" class="well auth-box">
                    <form>
                        <fieldset>
                            <!-- Form Name -->
                            <legend class="text-center " style=" margin-bottom: -17px;">محتويات العمل </legend><hr>
                            <a href="{{url('/process')}}" style="text-decoration: none;">
                                <legend class="btn btn-success text-center">العمل اليومى </legend>
                            </a>
                            <a href="{{url('/out_process')}}" style="text-decoration: none;">
                                <legend class="btn btn-success text-center"> العمل الخارجى</legend>
                            </a>
                            <a href="{{url('/insert_account')}}" style="text-decoration: none;">
                                <legend class="btn btn-success text-center">الحسابات الداخليه</legend>
                            </a>
                            <a href="{{url('/out_account')}}" style="text-decoration: none;">
                                <legend class="btn btn-success text-center">الحسابات الخارجيه</legend>
                            </a>
                            <a href="{{url('/remain_payment')}}" style="text-decoration: none;">
                                <legend class="btn btn-success text-center">حسابات التعاقدات</legend>
                            </a>
                            <a href="{{url('/employ')}}" style="text-decoration: none;">
                                <legend class="btn btn-success text-center">حسابات العاملين</legend>
                            </a>
                            <a href="{{url('/store')}}" style="text-decoration: none;">
                                <legend class="btn btn-success text-center"> المخزن</legend>
                            </a>
                            <a href="{{url('/out_store')}}" style="text-decoration: none;">
                                <legend class="btn btn-success text-center"> المخزن الخارجى </legend>
                            </a>
                        </fieldset>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection
