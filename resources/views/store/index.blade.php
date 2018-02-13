@extends('layouts.app')

@section('content')

    <script>
        $(document).ready(function () {
            $('#search_a').keyup(function () {
                var search = $('.search_a').val();
                $.ajax({
                    type:'get',
                    url: 'sort_a_search' ,
                    data:{search:search},
                    success:function(data){
                        $(".msg_a").html(data);
                    }
                });
            })
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#search_b').keyup(function () {
                var search = $('.search_b').val();
                $.ajax({
                    type:'get',
                    url: 'sort_b_search' ,
                    data:{search:search},
                    success:function(data){
                        $(".msg_b").html(data);
                    }
                });
            })
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#search_c').keyup(function () {
                var search = $('.search_c').val();
                $.ajax({
                    type:'get',
                    url: 'sort_c_search' ,
                    data:{search:search},
                    success:function(data){
                        $(".msg_c").html(data);
                    }
                });
            })
        });
    </script>


    <div class="container ">
        <div class="row">
            @include('include.message')
            <div class="col-lg-9 auth" style="margin-top: 100px;">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <div class="panel-heading " style="margin-right: 121px;">
                        {!! Form::open() !!}
                        <a href="{{url('store/create')}}" style=" margin-bottom: 10px;" class=" links btn btn-primary">
                            <span>لوحه اضافه شرائح جديده</span>
                        </a>

                        <span> - </span>
                        <a href="{{url('add_sort_b')}}" style=" margin-bottom: 10px;" class =" links btn btn-primary ">
                            <span>لوحه اضافه مسامير جديده</span>
                        </a>
                        <span> - </span>
                        <a href="{{url('add_sort_c')}}"style=" margin-bottom: 10px;" class="links btn btn-primary ">
                            <span>لوحه اضافه مسامير ذات قطر</span>
                        </a>
                        {!! Form::close() !!}
                    </div>

                    <div class="panel-body">
                        {!! Form::open() !!}
                        <div class="form-group">
                            <label for="name"
                                   class=" control-label">البحث : </label>
                                <input class="search_a form-control" style="margin-bottom: 10px;"
                                       type="text" name="search" placeholder="اكتب نوع الشريحه" id="search_a">
                        </div>
                        {!! Form::close() !!}

                        <div>
                            <h4 class="col-lg-2 text-center col-lg-offset-5 "
                                style="margin-top: 38px;margin-bottom:
                            30px;background: #40a01a24; padding: 10px;border-radius: 5px;">انواع الشرائح
                            </h4>
                        </div>

                        <table class=" msg_a table_process table" >
                            <tr style="color: white;">
                                <th style=" text-align: center;">النوع</th>
                                <th style=" text-align: center;">المقاس</th>
                                <th style=" text-align: center;">العدد </th>
                                <th style=" text-align: center;">تاريخ الاضافه</th>
                                <th style=" text-align: center;">تعديل</th>
                                <th style=" text-align: center;">حذف </th>
                            </tr>
                            @foreach($in_data as $processs)
                                <tr style="color: black;">
                                    <td>{{$processs->sort}}</td>
                                    <td>{{$processs->size}}</td>
                                    <td>{{$processs->num}}</td>
                                    <td>{{$processs->created_at->toFormattedDateString()}}</td>
                                    <td>
                                        {!! Form::open() !!}
                                        <a href="{{url('store/'.$processs->id.'/edit')}}"
                                           class="fa fa-trash-o  btn btn-primary btn-sm">تعديل
                                        </a>
                                        {!! Form::close() !!}
                                    </td>

                                    <td>
                                        {!! Form::open(['method'=>'DELETE' ,'route'=>['store.destroy',$processs->id]]) !!}
                                        {!! Form::submit('حذف',['class'=>'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="pagination"> {{$in_data->render()}} </div>
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

            <div class="col-lg-9 auth" style="margin-top: 20px;">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <div class="panel-body">
                        {!! Form::open() !!}
                        <div class="form-group">
                            <label for="name" class=" control-label">البحث : </label>
                                <input class="search_b form-control" style="margin-bottom: 20px"
                                       type="text" name="search" placeholder="اكتب نوع المسمار  " id="search_b">
                        </div>
                        {!! Form::close() !!}

                    <!-- Form Name -->
                        <div>
                            <h4 class="col-lg-2 text-center col-lg-offset-5 "
                                style="margin-bottom:
                            30px;background: #40a01a24; padding: 10px;border-radius: 5px;"> انواع المسامير
                            </h4>
                        </div>

                        <table class=" msg_b table_process table" >
                            <tr style="color: white;">
                                <th style=" text-align: center;">النوع</th>
                                <th style=" text-align: center;">المقاس</th>
                                <th style=" text-align: center;">العدد </th>
                                <th style=" text-align: center;">تاريخ الاضافه</th>
                                <th style=" text-align: center;">تعديل</th>
                                <th style=" text-align: center;">حذف </th>
                            </tr>
                            @foreach($data_b as $processs)
                                <tr style="color: black;">
                                    <td>{{$processs->sort}}</td>
                                    <td>{{$processs->size}}</td>
                                    <td>{{$processs->num}}</td>
                                    <td>{{$processs->created_at->toFormattedDateString()}}</td>
                                    <td>
                                        {!! Form::open() !!}
                                        <a href="{{url('edit/sort_b/'.$processs->id)}}" class="btn btn-primary btn-sm">تعديل</a>
                                        {!! Form::close() !!}
                                    </td>

                                    <td>
                                        {!! Form::open(['url'=>['remove_sort_b/'.$processs->id],'method'=>'post']) !!}
                                        {!! Form::submit('حذف',['class'=>'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="pagination"> {{$data_b->render()}} </div>
                </div>
            </div>

            <div class="col-lg-9 auth" style="margin-top: 20px;">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <div class="panel-body">
                        {!! Form::open() !!}
                        <div class="form-group">
                            <label for="name"
                                   class=" control-label">البحث : </label>
                                <input class="search_c form-control"
                                       type="text" name="search" placeholder="اكتب نوع المسمار ذات القطر"
                                       id="search_c">
                        </div>
                        {!! Form::close() !!}


                    <!-- Form Name -->
                        <div>
                            <h4 class="col-lg-3 text-center col-lg-offset-5 "
                                style="margin-bottom:
                            30px;background: #40a01a24; padding: 10px;border-radius: 5px;"> انواع المسامير ذات القطر
                            </h4>
                        </div>

                        <table class=" msg_c table_process table " >
                            <tr style="color: white;">
                                <th style=" text-align: center;">النوع</th>
                                <th style=" text-align: center;">المقاس</th>
                                <th style=" text-align: center;">القطر</th>
                                <th style=" text-align: center;">العدد </th>
                                <th style=" text-align: center;">تاريخ الاضافه</th>
                                <th style=" text-align: center;">تعديل</th>
                                <th style=" text-align: center;">حذف </th>
                            </tr>
                            @foreach($data_c as $processs)
                                <tr style="color: black;">
                                    <td>{{$processs->sort}}</td>
                                    <td>{{$processs->size}}</td>
                                    <td>{{$processs->cic}}</td>
                                    <td>{{$processs->num}}</td>
                                    <td>{{$processs->created_at->toFormattedDateString()}}</td>
                                    <td>
                                        {!! Form::open() !!}
                                        <a href="{{url('edit/sort_c/'.$processs->id)}}" class="btn btn-primary btn-sm">تعديل</a>
                                        {!! Form::close() !!}
                                    </td>

                                    <td>
                                        {!! Form::open(['url'=>['remove_sort_c/'.$processs->id],'method'=>'post']) !!}
                                        {!! Form::submit('حذف',['class'=>'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="pagination"> {{$data_b->render()}} </div>
                </div>
            </div>

            <div class="col-lg-4 auth" style="margin-top: 20px;">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <div class="panel-body">
                        <!-- Form Name -->
                        <div >
                            <h4 class=" text-center"
                                style="margin-top: -6px;background: #40a01a24; padding: 10px;border-radius: 5px;">
                                <span>العدد الكلى للمسامير ذات قطر</span>
                            </h4>
                        </div>

                        <table class=" table_process table" >
                            <tr style="color: white;">
                                <th style=" text-align: center;">النوع</th>
                                <th style=" text-align: center;">العدد </th>
                                <th style=" text-align: center;">تعديل</th>
                            </tr>
                            @foreach($total_c as $processs)
                                <tr style="color: black;">
                                    <td>{{$processs->sort}}</td>
                                    <td>{{$processs->num}}</td>
                                    <td>
                                        {!! Form::open()!!}
                                        <a href="{{url('edit/total_c/'.$processs->id)}}" class="btn btn-primary btn-sm">تعديل</a>
                                        {!! Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 auth" style="margin-top: 20px;">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <div class="panel-body">
                        <!-- Form Name -->
                        <div >
                            <h4 class=" text-center"
                                style="margin-top: -6px;background: #40a01a24; padding: 10px;border-radius: 5px;">
                                <span>العدد الكلى للمسامير</span>
                            </h4>
                        </div>

                        <table class="  table_process table " >
                            <tr style="color: white;">
                                <th style=" text-align: center;">النوع</th>
                                <th style=" text-align: center;">العدد </th>
                                <th style=" text-align: center;">تعديل</th>
                            </tr>
                            @foreach($total_b as $processs)
                                <tr style="color: black;">
                                    <td>{{$processs->sort}}</td>
                                    <td>{{$processs->num}}</td>
                                    <td>
                                        {!! Form::open() !!}
                                        <a href="{{url('edit/total_b/'.$processs->id)}}" class="btn btn-primary btn-sm">تعديل</a>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 auth" style="margin-top: 20px;">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <div class="panel-body">
                        <!-- Form Name -->
                        <div >
                            <h4 class=" text-center"
                                style="margin-top: -6px;background: #40a01a24; padding: 10px;border-radius: 5px;">
                                <span> العدد الكلى للشرائح</span>
                            </h4>
                        </div>

                        <table class="  table_process table " >
                            <tr style="color: white;">
                                <th style=" text-align: center;">النوع</th>
                                <th style=" text-align: center;">العدد </th>
                                <th style=" text-align: center;">تعديل</th>
                            </tr>
                            @foreach($total_a as $processs)
                                <tr style="color: black;">
                                    <td>{{$processs->sort}}</td>
                                    <td>{{$processs->num}}</td>
                                    <td>
                                        {!! Form::open()!!}
                                        <a href="{{url('edit/total_a/'.$processs->id)}}" class="btn btn-primary btn-sm">تعديل</a>
                                        {!! Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="pagination"> {{$total_a->render()}} </div>
    </div>
@endsection
