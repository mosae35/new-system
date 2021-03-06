@extends('layouts.app')

@section('content')

    <script>

        $(document).ready(function() {

            $('#get').click(function () {
                // var search = $('.search').val();
                $.ajax({
                    type: 'get',
                    url: '/work',
                    success: function (data) {
                        $(".k1").html(data);
                    }
                });
            })


            $('#get_2').click(function () {
                // var search = $('.search').val();
                $.ajax({
                    type: 'get',
                    url: '/work_2',
                    success: function (data) {
                        $(".k1").html(data);
                    }
                });
            })


            $('#get_3').click(function () {
                // var search = $('.search').val();
                $.ajax({
                    type: 'get',
                    url: '/work_3',
                    success: function (data) {
                        $(".k1").html(data);
                    }
                });
            })



            $('#save').click(function () {
                var id = $(this).data('id');
                var type = $('.type').val();
                var num = $('.num').val();
                var size = $('.size').val();
                var cic = $('.cic').val();
                var process = $('.process').val();
                $.ajax({
                    type: 'get',
                    url: '/out_with_this/'+id,
                    data: {type: type, num: num, size: size, cic: cic, process: process, id: id},
                    success: function (data) {
                        $(".output").html(data);
                    }
                });
            });




            $('#slam').click(function () {
                var machien_name = $('.name').val();
                var num = $('.number').val();
                var id = $(this).data('id');
                $.ajax({
                    type: 'get',
                    url: '/slam',
                    data:{machien_name:machien_name,num:num,id:id},
                    success: function (data) {
                        $(".machien_show").html(data);
                    }
                });
            })


            //machiens
            $('#new').click(function () {
                var data;
                $.ajax({
                    type:'get',
                    url: '/new/data',
                    data:{data:data},
                    success: function (data) {
                        $("#inmachien").html(data);
                    }
                });
            });

            $('#old').click(function () {
                var data;
                $.ajax({
                    type:'get',
                    url: '/old/data',
                    data:{data:data},
                    success: function (data) {
                        $("#inmachien").html(data);
                    }
                });
            });



            $('#out_used_1').click(function () {

                var id = $(this).data('id');

                $.ajax({
                    type:'get',
                    url: '/out/used_1',
                    data:{id:id},
                    success: function (data) {
                        $("#used_type_1").html(data);
                    }
                });
            });


            $('#out_used_2').click(function () {
                var id = $(this).data('id');
                $.ajax({
                    type:'get',
                    url: '/out/used_2',
                    data:{id:id},
                    success: function (data) {
                        $("#used_type_1").html(data);
                    }
                });
            });


            $('#out_used_3').click(function () {
                var id = $(this).data('id');
                $.ajax({
                    type:'get',
                    url: '/out/used_3',
                    data:{id:id},
                    success: function (data) {
                        $("#used_type_1").html(data);
                    }
                });
            });
        });

    </script>


    <div class="container " style="direction: rtl;">
            @include('include.message')

            <div class="col-lg-9 auth" style="margin-top: 96px;">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <div class="panel-heading ">
                        {!! Form::open()!!}
                        <a  class="btn btn-success "
                            style="color: white;text-decoration: none; font-size: 18px;"
                            href="\process\create"> اضافه حاله جديده </a><hr>
                        {!! Form::close()!!}
                    </div>


                    <div class="panel-body" style="direction: rtl">
                        <div class="col-lg-4 pull-right">
                            <h4> <span> الدكتور : {{$only_process->doctor}} </span></h4>
                        </div>
                        <div class="col-lg-4 pull-right">
                            <h4> <span> اسم الحاله : {{$only_process->name}} </span></h4>
                        </div>
                        <div class="col-lg-4 pull-right">
                            <h4><span> نوع الحاله : {{$only_process->type}}  </span></h4>
                        </div>
                        <div class="col-lg-4 pull-right">
                            <h4><span>المكان : {{$only_process->place}}  </span></h4>
                        </div>
                        <div class="col-lg-4 pull-right">
                            <h4> <span> الفنى   : {{$only_process->client}}  </span></h4>
                        </div>
                        <div class="col-lg-4 pull-right" style="margin-bottom: 20px;">
                            <h4><span> التاريخ : {{$only_process->created_at->toFormattedDateString()}}  </span></h4>
                        </div>


                        <!-- Form Name -->
                        <div>
                            <h4 class="col-lg-2 text-center col-lg-offset-5 "
                                style="margin-top: 38px;margin-bottom:
                            30px;background: #40a01a24; padding: 10px;border-radius: 5px;">الخارج مع الحالة
                            </h4>
                        </div>



                        <table class=" output table_process table " >
                            <tr style="color:white;">
                                <th style=" text-align: center;">المستخدم</th>
                                <th style=" text-align: center;">النوع</th>
                                <th style=" text-align: center;">الكميه</th>
                                <th style=" text-align: center;">المقاس</th>
                                <th style=" text-align: center;">القطر</th>
                                <th style=" text-align: center;">تعديل</th>
                                <th style=" text-align: center;">حذف</th>
                            </tr>
                            @foreach($info as $infos)
                            <tr style="color: black;">
                                <td>{{$infos->process == 1?'شرائح':'مسامير'}}</td>
                                <td style="width: 156px;">{{$infos->type}}</td>
                                <td>{{$infos->num}}</td>
                                <td style="width: 131px;">{{$infos->size}} H </td>
                                <td style="width: 102px;"><span> مسمار ذات قطر </span> {{$infos->cic}}  </td>
                                <td>
                                    {!! Form::open()!!}
                                    <a href="{{url('used/'.$infos->id.'/change')}}" class="btn btn-success btn-sm">تعديل</a>
                                    {!! Form::close()!!}
                                </td>
                                <td>
                                    {!! Form::open()!!}
                                    <a href="{{url('used/'.$infos->id.'/delete')}}" class="btn btn-danger btn-sm">حذف</a>
                                    {!! Form::close()!!}
                                </td>
                            </tr>
                                @endforeach>

                        </table>
                        <br>
                                     {!! Form::select('process',[ '1' =>'شرائح','2'=>'مسامير','3'=>'ذات قطر'],null,
                                     ['class'=>' process form-control','style'=>'background: rgba(177, 153, 192, 0.51);
                                     width: 113px; float: right;']) !!}

                                    <ul class="list-unstyled" style="float: right;">
                                        {!! Form::open() !!}
                                        <li style="font-size: 15px; margin-left: 10px; margin-top: -19px; float: left;" >
                                            <a class="btn btn-danger btn-xs typs"  id="get_3">ذات قطر </a>
                                        </li>
                                        <li style="font-size: 15px; margin-left: 10px; margin-top: -19px; float: left;">
                                            <a class="btn btn-danger btn-xs typs"  id="get_2">  مسامير  </a>
                                        </li>
                                        <li style="font-size: 15px; margin-left: 10px; margin-top: -19px; float: left;">
                                            <a class="btn btn-danger btn-xs typs" id="get">  شرائح </a>
                                        </li>
                                        {!! Form::close() !!}
                                    </ul>
                                    {!! Form::select('type',['0'=>'الانواع'],null,
                                         ['class'=>'type  k1 form-control',
                                         'style'=>'background:rgba(177, 153, 192, 0.51); margin-left: 29px;margin-right: -178px;
                                          width: 123px;margin-top: 1px;float: right;']) !!}

                                    {!! Form::number('num',null,['class'=>'num  form-control','placeholder'=>'الكميه','style'=>'
                                     background:rgba(177, 153, 192, 0.51);font-size: 20px;
                                     margin-left: 18px; margin-right:-34px; float: right;width: 78px;']) !!}

                                    {!! Form::number('size',null,['class'=>' size form-control','require','placeholder'=>'المقاس',
                                     'style'=>'margin-left: 15px; margin-right: -10px;font-size: 20px;
                                      background:rgba(177, 153, 192, 0.51);float: right;width:120px;height:39px;' ]) !!}

                                    {!! Form::number('cic',null,['class'=>' cic  form-control','placeholder'=>'القطر',
                                    'style'=>'margin-left:59px;background:rgba(177, 153, 192, 0.51);font-size: 20px;
                                    width: 87px; float: right;']) !!}

                        {!! Form::open() !!}
                        <a id="save" style="margin-right: -12px;" class="btn btn-primary"
                                data-id="{{$only_process->id}}">  حفظ  </a>
                        {!! Form::close() !!}


                        <hr>

                        <!-- Form Name -->
                        <div>
                            <h4 class="col-lg-3 text-center col-lg-offset-5 "
                                style="margin-top: 38px;margin-bottom:
                            30px;background: #40a01a24; padding: 10px;border-radius: 5px;">الالة الخارجة مع الحالة
                            </h4>
                        </div>



                        <table class=" machien_show  table_process table " >
                            <tr style="color: white;">
                                <th style=" text-align: center;">الاسم</th>
                                <th style=" text-align: center;">العدد</th>
                                <th style=" text-align: center;">تعديل</th>
                                <th style=" text-align: center;">حذف</th>
                            </tr>
                            @foreach($out_machien as $infos)
                                <tr style="color: black;">
                                    <td>{{$infos->machien_name}}
                                    <td>{{$infos->num}}
                                    <td>
                                        {!! Form::open() !!}
                                        <a href="{{url('machien/edit/'.$infos->id.'/'.$only_process->id)}}"
                                           class="btn btn-sm btn-success">تعديل</a>
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open() !!}
                                        <a href="{{url('machien/delete/'.$infos->id)}}" class="btn btn-sm btn-danger" >حذف</a>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach>

                        </table>

                        <div class="form-group col-lg-6">
                            {!! Form::number('num',null,['class'=>'form-control  number','placeholder'=>'العدد'
                            ,'style'=>'margin-top: 30px;background:rgba(177, 153, 192, 0.51);']) !!}
                        </div>
                        <div class="form-group col-lg-6">
                            {!! Form::open() !!}
                            <a class="btn btn-danger btn-sm" style="position: relative;top: -3px;" id="new"> الات </a>
                            <a class="btn btn-danger btn-sm" style="position: relative;top: -3px;"id="old">  مستلزمات  </a>
                            {!! Form::close() !!}
                            {!! Form::select('machien_name',['1'=>'اختر'],null,['class'=>'form-control  name',
                            'id'=>'inmachien', 'style'=>'background: rgba(177, 153, 192, 0.51);']) !!}
                        </div>
                        {!! Form::open() !!}
                        <a id="slam"  data-id="{{$only_process->id}}" class="btn btn-primary" style=" margin-top: 15px;
                           font-size: 18px;margin-right: 17px; width: 99px;"> حفظ </a>
                        {!! Form::close() !!}


                        <hr>

                        <!-- Form Name -->
                        <div>
                            <h4 class="col-lg-3 text-center col-lg-offset-5 "
                                style="margin-top: 38px;margin-bottom:
                            30px;background: #40a01a24; padding: 10px;border-radius: 5px;">الادوات المستخدمة مع الحالة
                            </h4>
                        </div>

                        <table class="table_process table ">
                            <tr style="color: white;">
                                <th style=" text-align: center;">المستخدم</th>
                                <th style=" text-align: center;">النوع</th>
                                <th style=" text-align: center;">الكميه</th>
                                <th style=" text-align: center;">المقاس</th>
                                <th style=" text-align: center;">القطر</th>
                            </tr>
                            @foreach($info_used as $info_useds)
                                <tr style="color: black;">
                                    <td>{{$info_useds->process == 1?'شرائح':'مسامير'}}</td>
                                    <td>{{$info_useds->type}}</td>
                                    <td>{{$info_useds->num}}</td>
                                    <td>{{$info_useds->size}}سم</td>
                                    <td><span> مسمار ذات قطر </span> {{$info_useds->cic}}  </td>
                                </tr>
                            @endforeach
                        </table>
                        <div class="clearfix"></div>

                        <hr>
                        <div class="col-lg-4 pull-right">
                            <h4> <span> المدفوع : {{$only_process->cash}}</span></h4>
                        </div>
                        <div class="col-lg-4 pull-right">
                            <h4><span> المتبقى : {{$only_process->not_cash}}</span></h4>
                        </div>
                        </div>
                    <div class="pagination">
                        {{$info->render()}}
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


            <div class="col-lg-9 auth" >

                <div id="big-form" class="well auth-box" style="margin-left: 388px;border-radius: 10px;margin-top: 21px;
                     width: 397px; margin-right: 2px;">
                    {!!  Form::open(['url'=>'process/used/'.$only_process->id ]) !!}
                    {{ csrf_field() }}
                    <fieldset>

                        <!-- Form Name -->
                        <legend class="text-center"> تسجيل المستخدم من الخارج لحاله  {{$only_process->name}} </legend>


                        <div class="form-group">
                            <label for="name" class=" control-label"> المستخدم </label>
                                {!! Form::select('process',['2'=>'مسامير','1'=>'شرائح','3'=>'مسامير ذات قطر ']
                                ,null,['class'=>'form-control']) !!}
                        </div>


                        <div class="form-group" >
                            <label for="name" class=" control-label">
                                <a class="btn btn-sm btn-success" id="out_used_1"
                                   data-id="{{$only_process->id}}" style="font-size: 15px;">  شرائح </a>

                                <a class="btn btn-sm btn-success" id="out_used_2"
                                   data-id="{{$only_process->id}}" style="font-size: 15px;">  مسامير  </a>

                                <a class="btn btn-sm btn-success" id="out_used_3"
                                   data-id="{{$only_process->id}}" style="font-size: 15px;">ذات قطر </a>
                            </label>
                                {!! Form::select('type',['1'=>'اختر'],null,
                                ['class'=>'form-control  name','id'=>'used_type_1']) !!}

                        </div>


                        <div class="form-group">
                            <label for="name" class=" control-label">المقاس:  <span>سم</span> </label>
                            {!! Form::number('size',null, ['class'=>'form-control']) !!}
                            @if ($errors->has('size'))
                                <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">{{ $errors->first('size') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="name" class=" control-label">العدد </label>
                            {!! Form::number('num',null, ['class'=>'form-control'   ]) !!}
                            @if ($errors->has('num'))
                                <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">{{ $errors->first('num') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="name" class=" control-label">القطر </label>
                            {!! Form::number('cic',null, ['class'=>'form-control']) !!}
                            @if ($errors->has('cic'))
                                <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">{{ $errors->first('cic') }}</strong></span>
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

            </div>

    </div>

@endsection

