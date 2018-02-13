@extends('layouts.app')

@section('content')

    <div class="container auth">
        <h1 class="text-center">لوحة التسجيل</h1>
        <div id="big-form" class="well auth-box">
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <fieldset>
                    <!-- Text input-->
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name"  control-label>الاسم :</label>
                            <input id="name" type="text" class="form-control input-md" placeholder="اللقب"
                                   name="name" value="{{ old('name') }}" autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block"><strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                        {{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                    </div>


                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">الحساب الشخصى</label>

                            <input id="email" type="email" class="form-control input-md"
                                   name="email" value="{{ old('email') }}"  placeholder="الايميل">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                            {{ $errors->first('email') }}
                                        </strong>
                                    </span>
                            @endif
                    </div>



                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class=" control-label">كلمة السر</label>

                            <input id="password" type="password" class="input-md form-control" name="password"
                                    placeholder="الباسورد">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong style="color: rgba(165, 27, 27, 0.74);font-size: 17px;">
                                            {{ $errors->first('password') }}
                                        </strong>
                                    </span>
                            @endif
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class=" control-label">تاكيد كلمه السر</label>
                        <input id="password-confirm" type="password" class="input-md form-control" placeholder="الباسورد"
                               name="password_confirmation" >
                    </div>
                    <!-- Button -->
                    <div class="form-group">
                            <button type="submit" id="singlebutton" name="singlebutton" class="btn btn-default">
                                Register
                            </button>
                    </div>

                </fieldset>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>


@endsection
