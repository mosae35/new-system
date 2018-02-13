@extends('layouts.app')

@section('content')

    <div class="container auth">
            @include('include.message')
            <div class="col-lg-9 auth" style=" margin-top: 103px;">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <div class="panel-heading ">
                        <h4  style="color:black;" class="pull-left"> الحالات التى لم تكمل عمليه الدفع فى الداخلى </h4>
                        <h4 >
                            {!! Form::open() !!}
                            <a style="text-decoration: none; font-size: 17px; color:black;"
                               href="\process\create" class="btn btn-primary"> اضافه حاله جديده فى العمل اليومى  </a>
                            {!! Form::close() !!}
                        </h4>
                    </div>
                    <div class="panel-body" style="direction: rtl">

                        <div>
                            <h4 > هذه الحاله تابعه لدوكتور : {{$data}} </h4>
                        </div>
                        <table class="table_process table" >
                            <tr style="color: white;">
                                <th style=" text-align: center;">اسم الحاله</th>
                                <th style=" text-align: center;">نوع الحاله</th>
                                <th style=" text-align: center;">المكان </th>
                                <th style=" text-align: center;">الفنى </th>
                                <th style=" text-align: center;">تاريخ الاضافه</th>
                            </tr>
                            @foreach($in_data as $processs)
                                <tr style="color: black;">
                                    <td>
                                        {!! Form::open() !!}
                                        <a href="{{url('insert_account/'.$processs->id)}}" class="btn btn-success btn-sm">
                                            {{$processs->name}}
                                        </a>
                                        {!! Form::close() !!}
                                    </td>
                                    <td>{{$processs->type}}</td>
                                    <td>{{$processs->place}}</td>
                                    <td>{{$processs->client}}</td>
                                    <td>{{$processs->created_at->toFormattedDateString()}}</td>

                                </tr>
                            @endforeach
                        </table>
                        @if(count($in_data) == 0)
                            <div class="erorrs" style="margin-left: 0px;">
                                <h4>  لا يوجد دكتور بهذا الاسم:  {{$data}}  </h4>
                                <span>فى الداخلى</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-3 auth" style="margin-bottom: 57px;">
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
            </div sty>

            <div class="col-lg-9 auth" style="margin-top: -50px;">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <div class="panel-heading ">
                        <h4 style="color: #000;" class="pull-left"> الحالات التى لم تكمل عمليه الدفع فى العمل الخارجى </h4>
                        <h4 >
                            {!! Form::open() !!}
                            <a style="text-decoration: none; font-size: 17px; color: black;" href="\out_process\create" class="btn btn-sm btn-primary">
                                <span>اضافه حاله جديده فى العمل الخارجى </span>
                            </a>
                            {!! Form::close() !!}
                        </h4>
                    </div>
                    <div class="panel-body" style="direction: rtl">

                        <div>
                            <h4 > هذه الحاله تابعه لدوكتور : {{$data}} </h4>
                        </div>
                        <table class="table_process table" >
                            <tr style="color: white;">
                                <th style=" text-align: center;">اسم الحاله</th>
                                <th style=" text-align: center;">نوع الحاله</th>
                                <th style=" text-align: center;">المكان </th>
                                <th style=" text-align: center;">الفنى </th>
                                <th style=" text-align: center;">تاريخ الاضافه</th>
                            </tr>
                            @foreach($out_data as $processs)
                                <tr style="color: black">
                                    <td>
                                        {!! Form::open() !!}
                                        <a href="{{url('out_account/'.$processs->id)}}" class="btn btn-success btn-sm">
                                            {{$processs->name}}
                                        </a>
                                        {!! Form::close() !!}
                                    </td>
                                    <td>{{$processs->type}}</td>
                                    <td>{{$processs->place}}</td>
                                    <td>{{$processs->client}}</td>
                                    <td>{{$processs->created_at->toFormattedDateString()}}</td>

                                </tr>
                            @endforeach
                        </table>
                        @if(count($out_data) == 0)
                            <div class="erorrs" style="margin-left: 0px;">
                                <h4>  لا يوجد دكتور بهذا الاسم: {{$data}} </h4>
                                <span>فى الخارجى</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
    </div>

@endsection