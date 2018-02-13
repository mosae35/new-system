<table class=" table_process table " >
    <tr style="color: white;">
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
            <td style="">{{$infos->num}}</td>
            <td  style="width: 131px;">{{$infos->size}}سم</td>
            <td style="width: 102px";> <span> مسمار ذات قطر </span> {{$infos->cic}} </td>
            <td>
                {!! Form::open() !!}
                <a href="{{url('out/'.$infos->id.'/change')}}" class="btn btn-sm btn-primary">تعديل</a>
                {!! Form::close() !!}
            </td>
            <td>
                {!! Form::open() !!}
                <a href="{{url('out/'.$infos->id.'/delete')}}" class="btn btn-sm btn-danger">حذف</a>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
</table>