@extends('layouts.app')

@section('content')


    <script>
        $(document).ready(function () {
            $('#search').keyup(function () {
                var search = $('.search').val();
                $.ajax({
                    type:'get',
                    url: 'in' ,
                    data:{search:search},
                    success:function(data){
                        $(".msg").html(data);
                    }
                });
            })
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#search_out').keyup(function () {
                var search_out = $('.search_out').val();
                $.ajax({
                    type:'get',
                    url: '/out' ,
                    data:{search_out:search_out},
                    success:function(data){
                        $(".msg_out").html(data);
                    }
                });
            })
        });
    </script>


    <div class="container ">

        @include('include.message')

        <div class="col-lg-9 auth" style=" margin-top: 100px;" >
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <div class="panel-heading ">
                        <h4 class="text-center"
                            style="background: #40a01a24; padding: 10px;border-radius: 5px;color: black;">
                            <span> معرفه جميع الحالات الخاصه بالدوكتور</span>
                        </h4>
                    </div>

                    <div class="panel-body" style="direction: rtl">
                        {!! Form::open(['url'=>'/search','method'=>'post']) !!}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="password" class=" control-label">اسم الدكتور :  </label>
                                {!! Form::text('name',null,
                                ['class'=>'form-control','required']) !!}
                        </div>

                        <div class="form-group">
                            <div class="col-lg-4">
                                {!! Form::submit('search',
                                ['class'=>'btn btn-primary pull-left']) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}
                </div>
                 </div>
             </div>
        <div class="col-lg-3 auth" style="margin-bottom: 10px;">
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

        <div class="col-lg-9 auth" style=" margin-bottom: 20px;">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <div class="panel-heading ">
                        <h4  style="color: black;" class="pull-left"> الحالات التى لم تكمل عمليه الدفع فى الداخلى </h4>
                        <h4 >
                            {!! Form::open() !!}
                            <a style="text-decoration: none;font-size: 17px; color: black;"
                               href="\process\create" class="btn btn-primary ">
                                <span>اضافه حاله جديده فى العمل اليومى</span>
                            </a>
                            {!! Form::close() !!}
                        </h4>
                    </div>
                    <div class="panel-body" style="direction: rtl">

                        {!! Form::open() !!}
                        <div class="form-group" style="margin-bottom: 40px;">
                            <label for="name" style="font-size: 20px;margin-right: 7px;margin-top: 2px;"
                                   class=" control-label">البحث : </label>

                            <div class="col-lg-11">
                                <input style=" margin-right: 12px;"
                                       class="search form-control"
                                       type="text" name="search" placeholder="اكتب اسم الحاله"
                                       id="search">
                            </div>
                        </div>
                        {!! Form::close() !!}

                        <table class=" msg table_process table " >
                            <tr style="color: white;">
                                <th style=" text-align: center;">اسم الحاله</th>
                                <th style=" text-align: center;">الدكتور</th>
                                <th style=" text-align: center;">نوع الحاله</th>
                                <th style=" text-align: center;">المكان </th>
                                <th style=" text-align: center;">الفنى </th>
                                <th style=" text-align: center;">تاريخ الاضافه</th>
                            </tr>
                            @foreach($in_process as $processs)
                                <tr style="color: black;">
                                    <td>
                                        {!! Form::open() !!}
                                        <a href="{{url('insert_account/'.$processs->id)}}" class="btn btn-sm btn-success">
                                            {{$processs->name}}
                                        </a>
                                        {!! Form::close() !!}
                                    </td>
                                    <td>{{$processs->doctor}}</td>
                                    <td>{{$processs->type}}</td>
                                    <td>{{$processs->place}}</td>
                                    <td>{{$processs->client}}</td>
                                    <td>{{$processs->created_at->toFormattedDateString()}}</td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="pagination"> {{$in_process->render()}} </div>
                </div>
            </div>

        <div class="col-lg-9 auth">
            <div style=" border-radius: 15px;background: #ffffff8f;">
                <div class="panel-heading ">
                    <h4 style="color: black;" class="pull-left"> الحالات التى لم تكمل عمليه الدفع فى الخارجى  </h4>
                    <h4>
                        {!! Form::open() !!}
                        <a style="text-decoration: none;" href="\out_process\create" class="btn btn-primary">
                            <span style="font-size: 17px; color: #000;"> اضافه حاله جديده فى العمل الخارجى</span>
                        </a>
                        {!! Form::close() !!}
                    </h4>
                </div>
                <div class="panel-body" style="direction: rtl">

                    {!! Form::open() !!}
                    <div class="form-group" style="margin-bottom: 40px;">
                        <label for="name" style="font-size: 20px;margin-right: 7px;margin-top: 2px;"
                               class=" control-label">البحث : </label>
                        <div class="col-lg-11">
                            <input style=" margin-right: 12px;"
                                   class="search_out form-control"
                                   type="text" name="search_out" placeholder="اكتب اسم الحاله"
                                   id="search_out">
                        </div>
                    </div>
                    {!! Form::close() !!}

                    <table class=" msg_out table_process table" >
                        <tr style="color: white;">
                            <th style=" text-align: center;">اسم الحاله</th>
                            <th style=" text-align: center;">الدكتور</th>
                            <th style=" text-align: center;">نوع الحاله</th>
                            <th style=" text-align: center;">المكان </th>
                            <th style=" text-align: center;">الفنى </th>
                            <th style=" text-align: center;">تاريخ الاضافه</th>
                        </tr>
                        @foreach($out_process as $processs)
                            <tr style="color: black;">
                                <td>
                                    {!! Form::open() !!}
                                    <a href="{{url('out_account/'.$processs->id)}}" class="btn btn-success btn-sm">
                                        {{$processs->name}}
                                    </a>
                                    {!! Form::close() !!}
                                </td>
                                <td>{{$processs->doctor}}</td>
                                <td>{{$processs->type}}</td>
                                <td>{{$processs->place}}</td>
                                <td>{{$processs->client}}</td>
                                <td>{{$processs->created_at->toFormattedDateString()}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="pagination"> {{$out_process->render()}} </div>
            </div>
        </div>
    </div>


@endsection