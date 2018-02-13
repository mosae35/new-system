<table class=" msg_c table_process table " >
    <tr style="color: white;">
        <th style=" text-align: center;">النوع</th>
        <th style=" text-align: center;">المقاس</th>
        <th style=" text-align: center;">العدد </th>
        <th style=" text-align: center;">تاريخ الاضافه</th>
        <th style=" text-align: center;">تعديل</th>
        <th style=" text-align: center;">حذف </th>
    </tr>
    @foreach($data as $processs)
        <tr style="color: black;">
            <td>{{$processs->sort}}</td>
            <td>{{$processs->size}}</td>
            <td>{{$processs->num}}</td>
            <td>{{$processs->created_at}}</td>
            <td>
                {!! Form::open() !!}
                <a href="{{url('out_edit/sort_b/'.$processs->id)}}" class="btn btn-primary btn-sm">تعديل</a>
                {!! Form::close() !!}
            </td>
            <td>
                {!! Form::open(['url'=>['out_remove_sort_b/'.$processs->id],'method'=>'post']) !!}
                {!! Form::submit('حذف',['class'=>'btn btn-danger btn-sm']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
</table>