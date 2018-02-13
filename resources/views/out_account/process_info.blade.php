@extends('layouts.app')

@section('content')

    <div class="container " style="direction: rtl;">
        <div class="row">
            @include('include.message')
            <div class="col-lg-8 col-lg-offset-2 auth" style="margin-bottom: 20px;">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <div class="panel-heading ">
                        <div class="col-lg-4 pull-left">
                            <h4>
                                {!! Form::open() !!}
                                <a style="" class=" all_process btn btn-primary" href="/out_account">
                                    <span> الرجوع الى  لجميع الحالات</span>
                                </a>
                                {!! Form::close() !!}
                            </h4>
                        </div>
                        <h4>
                            {!! Form::open() !!}
                            <a style="margin-right: auto;" class="all_process btn btn-primary" href="\out_process\create">
                                <span>اضافه حاله جديده</span>
                            </a>
                            {!! Form::close() !!}
                        </h4>
                    </div>
                    <div class="panel-body" style="direction: rtl">
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
                        <div class="col-lg-5 pull-right" style="margin-bottom: 20px;">
                            <h4><span> تاريخ الحاله : {{$only_process->created_at->toFormattedDateString()}}  </span></h4>
                        </div>

                        <!-- Form Name -->
                        <div>
                            <h4 class="col-lg-2 text-center col-lg-offset-5 " style="margin-top: 38px;margin-bottom:
                            30px;background: #40a01a24; padding: 10px;border-radius: 5px;">
                                <span>الخارج مع الحالة</span>
                            </h4>
                        </div>


                        <table class="table_process table" >
                            <tr style="color: white">
                                <th style=" text-align: center;">المستخدم</th>
                                <th style=" text-align: center;">النوع</th>
                                <th style=" text-align: center;">الكميه</th>
                                <th style=" text-align: center;">المقاس</th>
                            </tr>
                            @foreach($info as $infos)
                                <tr style="color: black;">
                                    <td>{{$infos->process == 1?'شرائح':'مسامير'}}</td>
                                    <td>{{$infos->type}}</td>
                                    <td>{{$infos->num}}</td>
                                    <td>{{$infos->size}} H </td>
                                </tr>
                            @endforeach
                        </table>

                        <!-- Form Name -->
                        <div>
                            <h4 class="col-lg-3 text-center col-lg-offset-5 " style="margin-top: 38px;margin-bottom:
                            30px;background: #40a01a24; padding: 10px;border-radius: 5px;">
                                <span>المستخدم مع الحالة</span>
                            </h4>
                        </div>
                        <table class="table_process table" >
                            <tr style="color: white;">
                                <th style=" text-align: center;">المستخدم</th>
                                <th style=" text-align: center;">النوع</th>
                                <th style=" text-align: center;">الكميه</th>
                                <th style=" text-align: center;">المقاس</th>
                            </tr>
                            @foreach($info_used as $info_useds)
                                <tr style="color: black;">
                                    <td>{{$info_useds->process == 1?'شرائح':'مسامير'}}</td>
                                    <td>{{$info_useds->type}}</td>
                                    <td>{{$info_useds->num}}</td>
                                    <td>{{$info_useds->size}}سم</td>
                                </tr>
                            @endforeach
                        </table>

                        <div class="col-lg-4 pull-right">
                            <h4> <span> المدفوع : {{$only_process->cash}}</span></h4>
                        </div>
                        <div class="col-lg-3 pull-right">
                            <h4><span> المتبقى : {{$only_process->in_cash}}</span></h4>
                        </div>
                        <div class="col-lg-5 pull-right">
                            <h4><span> تاريخ التعديل : {{$only_process->updated_at->toFormattedDateString()}}</span></h4>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-8 col-lg-offset-2 auth">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <div class="panel-heading ">
                        <h4 class="text-center"
                            style="background: #40a01a24; padding: 10px;border-radius: 5px;color: black;">
                            <span>المتبقى من المبلغ الخارجى</span>
                        </h4>
                    </div>
                    <div class="panel-body" style="direction: rtl">
                        {!! Form::open(['url'=>'/out_process/pay/'.$only_process->id]) !!}

                        <div class="form-group">
                            <label for="name"
                                   class=" control-label"> دفع المتبقى من المبلغ : </label>
                                {!! Form::number('pay',null,array('class'=>'form-control',
                                'style'=>'background-color: #fff0;')) !!}
                            @if ($errors->has('pay'))
                                <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                        {{ $errors->first('pay') }}</strong>
                                </span>
                            @endif
                        </div>
                        {!! Form::submit('دفع',['class'=>'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection