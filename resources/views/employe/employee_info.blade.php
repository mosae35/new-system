@extends('layouts.app')

@section('content')

    <div class="container " style="direction: rtl;">
        <div class="row">
            @include('include.message')
            <div class="col-lg-9 auth" style="margin-bottom: 20px; margin-top: 98px;">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                        <!-- Form Name -->

                    <div class="panel-header">

                    <h4 class="text-center"
                        style="background: #40a01a24; padding: 10px;border-radius: 5px; margin-bottom: 0px;">
                        {{$only_process->name}}
                    </h4>

                        <h4 class="text-center"
                            style="background: #40a01a24; padding: 10px;margin-top: -5px;
                            border-radius: 5px; margin-bottom: 40px;">
                            {{date('M')}} <span> شهر </span>
                        </h4>
                    </div>

                    <div class="panel-body" style="direction: rtl">

                        <div class="col-lg-4 pull-right">
                            <h4><span> العنوان : {{$only_process->address}}  </span></h4>
                        </div>
                        <div class="col-lg-4 pull-right">
                            <h4><span> الرقم القومى : {{$only_process->number}}  </span></h4>
                        </div>
                        <div class="col-lg-4 pull-right">
                            <h4><span>التيليفون : {{$only_process->telephone}}  </span></h4>
                        </div>
                        <div class="col-lg-4 pull-right">
                            <h4> <span> تليفون اخر    : {{$only_process->mobile}}  </span></h4>
                        </div>
                        <div class="col-lg-4 pull-right" style="margin-bottom: 20px;">
                            <h4><span> مكان العمل  : {{$only_process->place}}  </span></h4>
                        </div>
                        <div class="col-lg-4 pull-right" style="margin-bottom: 20px;">
                            <h4><span> تاريخ التعين : {{$only_process->created_at->toFormattedDateString()}}  </span></h4>
                        </div>


                        {!! Form::open(['method'=>'get','url'=>'employ/'.$only_process->id]) !!}

                        <div class="form-group">
                            <label for="name" class=" control-label">  تاريخ غياب العامل فى الشهر: </label>
                            {!! Form::select('month',month(),null, ['class'=>'form-control','required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('اخنر',['class'=>'btn btn-primary pull-left']) !!}
                        </div><br><br>

                            {!! Form::close() !!}
                            <table class="table_process table " style="margin-bottom: 40px;">
                                <tr style="color: white;">
                                    <th style=" text-align: center;">اليوم </th>
                                    <th style=" text-align: center;">اليوم </th>
                                </tr>
                                @foreach($month as $value)
                                    <tr style="color: black;">
                                        <td>{{$value->day}}</td>
                                        <td>{{$value->created_at->toFormattedDateString()}}</td>
                                    </tr>
                                    @endforeach
                            </table>
                            <hr>
                            {!! Form::open(['method'=>'get','url'=>'employ/'.$only_process->id]) !!}

                            <div class="form-group">
                                <label for="name"
                                       class=" control-label">  عددالساعات الاضافيه فى الشهر: </label>
                                    {!! Form::select('month',month(),null,
                                  ['class'=>'form-control','required']) !!}
                            </div>

                                <div class="form-group ">
                                    {!! Form::submit('اخنر',
                                  ['class'=>'btn btn-primary pull-left']) !!}
                                </div>
                            <br><br>
                            {!! Form::close() !!}

                            <table class="table_process table"style="margin-bottom: 40px;">
                                <tr style="color: white;">
                                    <th style=" text-align: center;">عدد الساعات </th>
                                    <th style=" text-align: center;">اليوم </th>
                                </tr>
                                @foreach($month_hour as $value)
                                    <tr style="color: black;">
                                        <td>{{$value->hour}}</td>
                                        <td>{{$value->created_at->toFormattedDateString()}}</td>
                                    </tr>
                                @endforeach
                            </table>

                            <hr>
                            {!! Form::open(['method'=>'get','url'=>'employ/'.$only_process->id]) !!}

                            <div class="form-group">
                                <label for="name"
                                       class=" control-label">  قيمه السلف للعامل فى الشهر: </label>
                                    {!! Form::select('month',month(),null,
                                  ['class'=>'form-control','required']) !!}
                            </div>
                                <div class="form-group ">
                                    {!! Form::submit('اخنر',
                                  ['class'=>'btn btn-primary pull-left']) !!}
                                </div><br><br>
                            {!! Form::close() !!}
                            <table class="table_process table" >
                                <tr style="color: white;">
                                    <th style=" text-align: center;">قيمه المبلغ </th>
                                    <th style=" text-align: center;">الشهر </th>
                                </tr>
                                @foreach($month_balance as $value)
                                    <tr style="color: black;">
                                        <td>{{$value->amount}} <span> ج.م </span></td>
                                        <td>{{$value->created_at->toFormattedDateString()}}</td>
                                    </trsty>
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


            <div class="col-lg-9 auth" style="margin-bottom: 20px;">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <h4 class="col-lg-4 col-lg-offset-4 text-center"
                        style="background: #40a01a24; padding: 10px;border-radius: 5px;">
                        <span> تسجيل غياب العامل</span> {{$only_process->name}}
                    </h4>
                    <br><br>

                    <div class="panel-body" style="direction: rtl">
                        {!!  Form::open(['url'=>'employee/absent/'.$only_process->id ]) !!}
                        <div class="form-group">
                            <label for="name" class=" control-label">اليوم:</label>
                            {!! Form::number('day',null,['class'=>'form-control', 'style'=>'background-color: #fff0;']) !!}
                            @if ($errors->has('day'))
                                <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                        {{ $errors->first('day') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name"
                                   class=" control-label">الشهر: </label>
                                {!! Form::select('month',month(),null,
                              ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="name" class=" control-label">السنه </label>
                            {!! Form::number('year',null, ['class'=>'form-control','style'=>'background-color: #fff0;']) !!}
                            @if ($errors->has('year'))
                                <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                        {{ $errors->first('year') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::submit('غياب',['class'=>'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="col-lg-9 auth" style="margin-bottom: 20px;">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <h4 class="col-lg-4 col-lg-offset-4 text-center"
                        style="background: #40a01a24; padding: 10px;border-radius: 5px;">
                        <span>عدد الساعات الاضافيه للعامل</span> {{$only_process->name}}
                    </h4>
                    <br><br>

                    <div class="panel-body">
                        {!!  Form::open(['url'=>'employ/add_hour/'.$only_process->id ]) !!}
                        <div class="form-group">
                            <label for="name" class=" control-label">عدد الساعات: </label>
                            {!! Form::number('hour',null,['class'=>'form-control','style'=>'background-color: #ffffff12;']) !!}
                            @if ($errors->has('hour'))
                                <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                        {{ $errors->first('hour') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name" class=" control-label">الشهر:   </label>
                            {!! Form::select('month',month(),null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('حفظ',['class'=>'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="col-lg-9 auth">
                <div style=" border-radius: 15px;background: #ffffff8f;">
                    <h4 class="col-lg-4 col-lg-offset-4 text-center"
                        style="background: #40a01a24; padding: 10px;border-radius: 5px;">
                        <span>قيمه السلف للعامل</span> {{$only_process->name}}
                    </h4>
                    <br><br>

                    <div class="panel-body" style="direction: rtl">
                        {!!  Form::open(['url'=>'employ/money/'.$only_process->id ]) !!}

                        <div class="form-group">
                            <label for="name" class=" control-label"> المبلغ المطلوب :   </label>
                            {!! Form::number('amount',null,['class'=>'form-control','style'=>'background-color: #ffffff12;']) !!}
                            @if ($errors->has('amount'))
                                <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                        {{ $errors->first('amount') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name" class=" control-label">الشهر:   </label>
                            {!! Form::select('month',month(),null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                                {!! Form::submit('حفظ', ['class'=>'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="col-lg-9 auth" style="margin-top: 20px;">
                <div style=" border-radius: 15px;background: #ffffff8f;">

                    <div class="panel-heading">
                        <h4 class="col-lg-5 text-center"
                            style="background: rgba(208, 48, 48, 0.27); padding: 10px;border-radius: 5px;">
                            <span> لاحظ: لا يمكنك التعديل على هذه البيانات اوالبيانات السابقه بعد استخدام هذه اللوحه </span>
                        </h4>
                        <h4 class="col-lg-5  col-lg-offset-2 text-center"
                            style="background: #40a01a24; padding: 10px;border-radius: 5px;">
                            <span> تستخدم هذه اللوحه عند نهايه كل الشهر لحساب راتب العامل :</span>
                            {{$only_process->name}}
                        </h4>
                    </div>
                    <br><br>

                    <div class="panel-body" style="direction: rtl">
                        <h4> عدد ايام الغياب: {{$num_day}} يوم </h4>
                        <h4> عدد الساعات الاضافيه: {{$num_hour}} ساعات </h4>
                        <h4> قيمه السلف خلال هذا الشهر : {{$money}} ج.م</h4>


                        {!!  Form::open(['url'=>'employ/account/'.$only_process->id ]) !!}

                        <div class="form-group">
                            <label for="name" class=" control-label">قيمه الساعه الاضافيه:   </label>
                            {!! Form::number('hour',null, ['class'=>'form-control', 'style'=>'background-color: #ffffff3b;' ]) !!}
                            @if ($errors->has('hour'))
                                <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                {{ $errors->first('hour') }}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="name" class=" control-label">قيمه يوم الغياب :   </label>
                            {!! Form::number('day',null,['class'=>'form-control','style'=>'background-color: #ffffff3b;']) !!}
                            @if ($errors->has('day'))
                                <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                {{ $errors->first('day') }}</strong>
                        </span>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="name" class=" control-label">الراتب الاساسى:   </label>
                            {!! Form::number('account',null,['class'=>'form-control','style'=>'background-color: #ffffff3b;']) !!}
                            @if ($errors->has('account'))
                                <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                {{ $errors->first('account') }}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="name" class=" control-label">السنه:   </label>
                            {!! Form::number('year',null, ['class'=>'form-control','style'=>'background-color: #ffffff3b;']) !!}
                            @if ($errors->has('year'))
                                <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                {{ $errors->first('year') }}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="name" class=" control-label">الشهر:   </label>
                            {!! Form::select('month',month(),null, ['class'=>'form-control']) !!}
                            @if ($errors->has('month'))
                                <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                {{ $errors->first('month') }}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::submit('الراتب', ['class'=>'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}

                        <hr>
                        <div class="panel-body" style="direction: rtl">
                            <h3 style="background: #40a01a24; padding: 10px;border-radius: 5px;"
                            > راتب العامل  :   {{$employ_account}}  ج.م </h3>
                            @if(count($info) != 0 )
                                <h3 style="background: #40a01a24; padding: 10px;border-radius: 5px;">
                                    <span>   هذا العامل   : {{$only_process->name}}</span>
                                    <span> ليس لديه او عليه مستحقات ماليه اخرى خلال هذا الشهر {{$_GET['month']}}</span>
                                </h3>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection