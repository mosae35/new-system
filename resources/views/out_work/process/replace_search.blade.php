<table class="  table_process table " >
    <tr style="color: white;">
        <th style=" text-align: center;">اسم الحاله</th>
        <th style=" text-align: center;">الدكتور</th>
        <th style=" text-align: center;">نوع الحاله</th>
        <th style=" text-align: center;">المكان </th>
        <th style=" text-align: center;">الفنى </th>
        <th style=" text-align: center;">تاريخ الاضافه</th>
        <th style=" text-align: center;">تعديل</th>
        <th style=" text-align: center;">حذف</th>
    </tr>
    @foreach($data as $processs)
        <tr style="color: black;">
            <td>
                {!! Form::open() !!}
                <a href="{{url('out_process/'.$processs->id)}}" class="btn btn-sm btn-success">{{$processs->name}}</a>
                {!! Form::close() !!}</td>
            <td>{{$processs->doctor}}</td>
            <td>{{$processs->type}}</td>
            <td>{{$processs->place}}</td>
            <td>{{$processs->client}}</td>
            <td>{{$processs->created_at}}</td>
            <td>
                {!! Form::open() !!}
                <a class="btn btn-primary btn-sm" href="{{url('out_process/'.$processs->id.'/edit')}}">تعديل</a>
                {!! Form::close() !!}
            </td>
            <td>
                {!! Form::open(['method'=>'DELETE' ,'route'=>['out_process.destroy',$processs->id]]) !!}
                {!! Form::submit('حذف',['class'=>'btn btn-danger btn-sm']) !!}
                {!! Form::close() !!}</td>
        </tr>
    @endforeach
</table>