
<fieldset>
    <!-- label -->
    @if(isset($cic))
        <legend class="text-center">اضافه مسمار ذات قطر جديده فى المخزن </legend>
    @endif
    @if(isset($sort_b))
        <legend class="text-center">اضافه مسمار جديد فى المخزن </legend>
    @endif
    @if(isset($sort_a_n))
        <legend class="text-center">اضافه شريحة جديد فى المخزن </legend>
    @endif
    @if(isset($edit_a))
        <legend class="text-center"> التعديل على الشريحه </legend>
    @endif
    @if(isset($edit_b))
        <legend class="text-center"> التعديل على المسامير </legend>
    @endif
    @if(isset($edit_c))
        <legend class="text-center"> التعديل على المسامير ذات القطر </legend>
    @endif


    <div class="form-group">
        <label for="name" class=" control-label">النوع :</label>
        {!! Form::text('sort',null,['class'=>'form-control']) !!}
        @if ($errors->has('sort'))
            <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                    {{ $errors->first('sort') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="name" class=" control-label">المقاس :</label>
        {!! Form::number('size',null, ['class'=>'form-control']) !!}
        @if ($errors->has('size'))
            <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                    {{ $errors->first('size') }}</strong>
            </span>
        @endif
    </div>

    @if(isset($cic))
        <div class="form-group">
            <label for="name" class=" control-label">القطر :</label>
            {!! Form::number('cic',null,['class'=>'form-control']) !!}
            @if ($errors->has('cic'))
                <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                    {{ $errors->first('cic') }}</strong>
            </span>
            @endif
        </div>
    @endif

    <div class="form-group">
        <label for="name" class=" control-label">العدد :</label>
        {!! Form::number('num',null,['class'=>'form-control']) !!}
        @if ($errors->has('num'))
            <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                    {{ $errors->first('num') }}</strong>
            </span>
        @endif
    </div>


    <div class="form-group ">
        <div class="col-lg-8">
            {!! Form::submit('تسجيل',['class'=>'btn btn-success pull-left']) !!}
        </div>
    </div>
</fieldset>



