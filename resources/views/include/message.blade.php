
@if(count($errors) > 0)
    <div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="alert alert-danger">
            <button style="font-size: 22px;" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong class="text-center" style="font-size: 20px;margin-right: 8px;">رسالة تحزيرية</strong>
            <hr class="message-inner-separator">
            <p>
               <ul>
                 @foreach($errors->all() as $errors)
                    <li style="font-size: 17px;">  {{ $errors }} </li>
                 @endforeach
                </ul>
            </p>
        </div>
    </div>
    </div>
@endif


@if(Session::has('message'))
    <div class="row">
<div class="col-sm-12 col-md-12">
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            ×</button>
        <strong style=" margin-right: 7px;">Success Message</strong>
        <hr class="message-inner-separator">
        <p style="font-size: 17px;">{{Session::get('message')}}</p>
    </div>
</div>
    </div>
        @endif

