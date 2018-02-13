<table class=" msg table_process table " >
    <tr style="color: white;">
        <th style=" text-align: center;">اسم الحاله</th>
        <th style=" text-align: center;">المدفوع</th>
        <th style=" text-align: center;">المتبقى </th>
        <th style=" text-align: center;">الفنى </th>
        <th style=" text-align: center;">تاريخ الاضافه</th>
        <th style=" text-align: center;">تعديل</th>
    </tr>
    @foreach($data as $processs)
        <tr style="color: black;">
            <td>
                {!! Form::open() !!}
                <a href="{{url('/out_account/'.$processs->id)}}" class="btn btn-sm btn-success">{{$processs->name}}</a>
                {!! Form::close() !!}
            </td>
            <td>{{$processs->cash}} ج.م</td>
            <td>{{$processs->in_cash}}  ج.م</td>
            <td>{{$processs->client}}</td>
            <td>{{$processs->created_at}}</td>
            <td>
                {!! Form::open() !!}
                 <a class="btn btn-primary btn-sm" href="{{url('out_process/'.$processs->id.'/edit')}}">تعديل</a>
                {!! Form::close() !!}
            </td>

        </tr>
    @endforeach
</table>