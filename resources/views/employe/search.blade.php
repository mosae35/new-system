<table class="table_process table table-bordered" >
        <tr style="color: white">
                <th style=" text-align: center;">اسم العامل</th>
                <th style=" text-align: center;">عنوان العامل</th>
                <th style=" text-align: center;">رقم التليفون  </th>
                <th style=" text-align: center;">تاريخ الاضافه</th>
                <th style=" text-align: center;">تعديل</th>
                <th style=" text-align: center;">حذف</th>
        </tr>
        @foreach($data as $processs)
                <tr style="color: black">
                        <td>
                                {!! Form::open() !!}
                                <a href="{{url('employ/'.$processs->id)}}" class="btn btn-sm btn-success">{{$processs->name}}</a>
                                {!! Form::close() !!}
                        </td>
                        <td>{{$processs->address}}</td>
                        <td>{{$processs->telephone}}</td>
                        <td>{{$processs->created_at}}</td>
                        <td>
                                {!! Form::open() !!}
                                <a class="btn btn-primary btn-sm" href="{{url('/employ/'.$processs->id.'/edit')}}">تعديل</a>
                                {!! Form::close() !!}
                        </td>
                        <td>
                                {!! Form::open(['method'=>'DELETE' ,'route'=>['employ.destroy',$processs->id]]) !!}
                                {!! Form::submit('حذف',['class'=>'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}</td>
                </tr>
        @endforeach
</table>