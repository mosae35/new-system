<table class=" msg table_process table table-bordered" >
    <tr STYLE="color: white;">
        <th style=" text-align: center;">اسم الحاله</th>
        <th style=" text-align: center;">الدكتور</th>
        <th style=" text-align: center;">نوع الحاله</th>
        <th style=" text-align: center;">المكان </th>
        <th style=" text-align: center;">الفنى </th>
        <th style=" text-align: center;">تاريخ الاضافه</th>
    </tr>
    @foreach($data as $processs)
        <tr style="color: black;">
            <td>
                {!! Form::open() !!}
                <a href="{{url('insert_account/'.$processs->id)}}" class="btn btn-success btn-sm">
                    {{$processs->name}}
                </a>
                {!! Form::close() !!}
            </td>
            <td>{{$processs->doctor}}</td>
            <td>{{$processs->type}}</td>
            <td>{{$processs->place}}</td>
            <td>{{$processs->client}}</td>
            <td>{{$processs->created_at}}</td>

        </tr>
    @endforeach
</table>