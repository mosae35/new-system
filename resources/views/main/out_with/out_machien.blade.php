<table class=" table_process table table-bordered" >
    <tr style="color: white;">
        <th style=" text-align: center;">الاسم:</th>
        <th style=" text-align: center;">العدد:</th>
        <th style=" text-align: center;">تعديل</th>
        <th style=" text-align: center;">حذف</th>
    </tr>
    @foreach($machien as $infos)
        <tr style="color: black;">
            <td>{{$infos->machien_name}}</td>
            <td>{{$infos->num}}</td>
            <td>
                {!! Form::open() !!}
                <a href="{{url('machien/edit/'.$infos->id.'/'.$infos->process_id)}}" class="btn btn-success btn-sm"> تعديل </a>
                {!! Form::close() !!}
            </td>
            <td>
                {!! Form::open() !!}
                <a href="{{url('machien/delete/'.$infos->id)}}" class="btn btn-danger btn-sm"> حذف </a>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach>

</table>