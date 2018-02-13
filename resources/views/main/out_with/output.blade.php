<table class=" output table_process table table-bordered" >
    <tr >
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
    @endforeach
</table>