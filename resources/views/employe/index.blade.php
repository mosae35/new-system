@extends('layouts.app')

@section('content')

    <script>
        $(document).ready(function () {
            $('#search').keyup(function () {
                var search = $('.search').val();
                $.ajax({
                    type:'get',
                    url: 'employ_search' ,
                    data:{search:search},
                    success:function(data){
                        $(".msg").html(data);
                    }
                });
            })
        });
    </script>

    <div class="container ">
        @include('include.message')
        <div class="col-lg-9 auth" style="margin-top: 98px;">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <div class="panel-heading ">
                        {!! Form::open()!!}
                        <a  class="btn btn-success " style="color: white;text-decoration: none; font-size: 18px;" href="\employ\create"> اضافه عامل </a><hr>
                        {!! Form::close()!!}
                    </div>

                    <div class="panel-body" style="direction: rtl">

                        {!! Form::open() !!}
                        <div class="form-group" style="margin-bottom: 40px;">
                            <label for="name" style="font-size: 20px;margin-right: 7px;margin-top: 2px;" class=" control-label">البحث : </label>

                            <div class="col-lg-11">
                                <input style=" margin-right: 12px;"
                                       class="search form-control"
                                       type="text" name="search" placeholder="اكتب اسم الحاله" id="search">
                            </div>
                        </div>
                        {!! Form::close() !!}


                        <table class=" msg table_process table" >
                            <tr style="color: white">
                                <th style=" text-align: center;">اسم العامل</th>
                                <th style=" text-align: center;">رقم التليفون  </th>
                                <th style=" text-align: center;">تاريخ الاضافه</th>
                                <th style=" text-align: center;">تعديل</th>
                                <th style=" text-align: center;">حذف</th>
                            </tr>
                            @foreach($process as $processs)
                                <tr style="color: black;">
                                    <td>
                                        {!! Form::open() !!}
                                        <a href="{{url('employ/'.$processs->id)}}" class="btn btn-success btn-sm">{{$processs->name}}</a>
                                        {!! Form::close() !!}
                                    </td>
                                    <td>{{$processs->telephone}}</td>
                                    <td>{{$processs->created_at->toFormattedDateString()}}</td>
                                    <td>
                                        {!! Form::open() !!}
                                        <a class="btn btn-primary btn-sm" href="{{url('/employ/'.$processs->id.'/edit')}}">تعديل</a>
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['method'=>'DELETE' ,'route'=>['employ.destroy',$processs->id]]) !!}
                                        {!! Form::submit('حذف',['class'=>'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="text-center">
                    {{$process->render()}}
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

@endsection