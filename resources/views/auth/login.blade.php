@extends('layouts.app')

@section('content')

    <div class="container auth">
        <h1 class="text-center">لوحة تسجيل الدخول  </h1>
        <div id="big-form" class="well auth-box">
            <form class="form-horizontal" style="margin-top: 25px;" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <fieldset>

                    <!-- Form Name -->
                    <legend class="text-center"> تسجيل الدخول </legend>

                    <!-- email input-->
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email"class=" control-label">الحساب الشخصى </label>
                            <input id="email"  type="email" class="input-md form-control" name="email"
                                   value="{{ old('email') }}" placeholder="الايميل" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                    </div>


                    <!-- Password input-->

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password"  class="control-label">كلمه السر</label>
                            <input id="password" type="password" placeholder="الباسورد"
                                   class="form-control input-md" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                    </div>

                    <!-- Button (Double) -->
                    <div class="form-group">
                            <button type="submit" style="margin-right: 19px;margin-top: 20px; font-size: 20px;"
                                    class=" btn btn-success " id="button1id">
                                <span> تسجيل الدخول</span>
                            </button>
                        <!--  <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>-->
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>


@endsection
