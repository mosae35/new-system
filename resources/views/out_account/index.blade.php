@extends('layouts.app')

@section('content')


    <script>
        $(document).ready(function () {
            $('#search').keyup(function () {
                var search = $('.search').val();
                $.ajax({
                    type:'get',
                    url: '/out_acount' ,
                    data:{search:search},
                    success:function(data){
                        $(".msg").html(data);
                    }
                });
            })
        });
    </script>


    <div class="container ">
        <div class="row">
            @include('include.message')
            <div class="col-lg-9 auth" style="margin-top: 98px;">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <div class="panel-heading ">
                        <h4 class="text-center"
                            style="background: #40a01a24; padding: 10px;border-radius: 5px;color: black;"> الحسابات الخارجية</h4>
                    </div>
                    <hr>
                    <div class="panel-body" style="direction: rtl">
                        {!! Form::open() !!}
                        <div class="form-group" style="margin-bottom:40px;">
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

                        <table class=" msg table_process table" >
                            <tr style="color: white;">
                                <th style=" text-align: center;">اسم الحاله</th>
                                <th style=" text-align: center;">المدفوع</th>
                                <th style=" text-align: center;">المتبقى </th>
                                <th style=" text-align: center;">الفنى </th>
                                <th style=" text-align: center;">تاريخ الاضافه</th>
                                <th style=" text-align: center;">تعديل</th>
                            </tr>
                            @foreach($data as $processs)
                                <tr style="color: black">
                                    <td>
                                        {!! Form::open() !!}
                                        <a href="{{url('/out_account/'.$processs->id)}}" class="btn btn-sm btn-success">
                                            {{$processs->name}}
                                        </a>
                                        {!! Form::close() !!}
                                    </td>
                                    <td>{{$processs->cash}} ج.م</td>
                                    <td>{{$processs->in_cash}}  ج.م</td>
                                    <td>{{$processs->client}}</td>
                                    <td>{{$processs->created_at->toFormattedDateString()}}</td>
                                    <td>
                                        {!! Form::open() !!}
                                        <a class="btn btn-primary btn-sm" href="{{url('out_process/'.$processs->id.'/edit')}}">تعديل</a>
                                        {!! Form::close() !!}
                                    </td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="pagination">
                        {{$data->render()}}
                    </div>
                </div>
            </div>


            <div class="col-lg-3 auth" style="margin-bottom: 20px;">
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



            <div class="col-lg-9 auth" style="margin-bottom: 20px;">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <div class="panel-heading ">
                        <h4 class="text-center"
                            style="background: #40a01a24; padding: 10px;border-radius: 5px;color: black;"> القيم المسحوبه من المبلغ الاجمالى الخارجى</h4>
                    </div>
                    <div class="panel-body" style="direction: rtl">

                        <table class="table_process table " >
                            <tr style="color: white;">
                                <th style=" text-align: center;">القيمه المسحوبه</th>
                                <th style=" text-align: center;">غرض السحب</th>
                                <th style=" text-align: center;">تاريخ السحب</th>
                            </tr>
                            @foreach($get_money as $get)
                                <tr style="color: black;">
                                    <td> {{$get->money }}  ج.م</td>
                                    <td>{{$get->object}}</td>
                                    <td>{{$get->created_at}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="pagination">{{$get_money->render()}} </div>
                </div>
            </div>


            <div class="col-lg-9 auth" style="margin-bottom: 20px;">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <div class="panel-heading ">
                        <h4 class="text-center"
                            style="background: #40a01a24; padding: 10px;border-radius: 5px;color: black;"> الحساب الكلى الخارجى</h4>
                    </div>
                    <div class="panel-body" style="direction: rtl">
                        <div class="col-lg-6 pull-right">
                            <h4><span>  المجموع المدفوع فى جميع الحالات : {{$account}} ج.م </span></h4>
                        </div>
                        <div class="col-lg-6 pull-right">
                            <h4><span>  المجموع المتبقى فى جميع الحالات : {{$in_account}} ج.م </span></h4>
                        </div>
                        <div class="col-lg-6 pull-right">
                            <h4><span>  مجموع القيمه المسحوبه  : {{$total_get_money}} ج.م </span></h4>
                        </div>
                        <div class="col-lg-6 pull-right">
                            <h4><span>  الحساب الحالى لدى الشركه  : {{$payments}} ج.م </span></h4>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-9 auth">
                <div style=" border-radius: 15px;background: #ffffff8f;">

                    <div class="panel-heading ">
                        <h4 class="text-center"
                            style="background: #40a01a24; padding: 10px;border-radius: 5px;color: black;"> قيمه السحب من المبلغ الاجمالى الخارجى</h4>
                    </div>
                    <div class="panel-body" style="direction: rtl">
                        {!! Form::open(['url'=>'out_process/get']) !!}

                        <div class="form-group">
                            <label for="name" class=" control-label"> قيمه السحب: </label>
                                {!! Form::number('money',null,array('class'=>'form-control',
                                'style'=>'background-color: #fff0;')) !!}
                            @if ($errors->has('money'))
                                <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                        {{ $errors->first('money') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name" class=" control-label"> غرض السحب : </label>
                                {!! Form::textarea('object',null,array('class'=>'form-control',)) !!}
                            @if ($errors->has('object'))
                                <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                        {{ $errors->first('object') }}</strong>
                                </span>
                            @endif
                        </div>
                        {!! Form::submit('سحب',['class'=>'btn btn-primary']) !!}
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection