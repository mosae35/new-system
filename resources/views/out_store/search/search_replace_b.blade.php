<table class=" msg_c table_process table table-bordered" >
    <tr>
        <th style=" text-align: center;">النوع</th>
        <th style=" text-align: center;">المقاس</th>
        <th style=" text-align: center;">القطر</th>
        <th style=" text-align: center;">العدد </th>
        <th style=" text-align: center;">تاريخ الاضافه</th>
        <th style=" text-align: center;">تعديل</th>
        <th style=" text-align: center;">حذف </th>
    </tr>
    @foreach($data as $processs)
        <tr>
            <td>{{$processs->sort}}</td>
            <td>{{$processs->size}}</td>
            <td>{{$processs->cic}}</td>
            <td>{{$processs->num}}</td>
            <td>{{$processs->created_at}}</td>
            <td><a href="{{url('out_edit/sort_b/'.$processs->id)}}" class="btn btn-primary">تعديل</a></td>

            <td>
                {!! Form::open(['url'=>['remove_sort_b/'.$processs->id],'method'=>'post']) !!}
                {!! Form::submit('حذف',['class'=>'btn btn-danger']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
</table>