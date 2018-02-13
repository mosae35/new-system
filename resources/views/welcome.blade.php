<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title> المتحدة للادوات الطبيه </title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/main.css')}}" rel="stylesheet" type="text/css">

    </head>
    <body>
    <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a style="color: white;" href="{{ url('/home') }}">الرئيسية</a>

                        <a style="color: white;" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            تسجيل الخروج
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                    @else

                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    @include('include/message')

                    <div class="container auth">
                        <h1 class="text-center">المتحدة للادوات الطبيه  </h1>
                        <div id="big-form" class="well auth-box">
                            <form>
                                <fieldset>
                                    <!-- Form Name -->
                                    <legend>لاحظ:لا يمكنك استخدام التطبيق الا من خلال موافقه المدير</legend>
                                    <!-- Button (Double) -->
                                    <div class="form-group">
                                        <div class="">
                                            <button id="button1id" name="button1id" class="btn btn-success">
                                                <a style="font-size: 20px;color: white; text-decoration: none; "
                                                   href="{{ route('login') }}">تسجيل الدخول</a>
                                            </button>
                                            <button id="button2id" name="button2id" class="btn btn-success">
                                                <a style="color: white;font-size: 20px; text-decoration: none; "
                                                   href="{{ route('register') }}">التسجيل</a>
                                            </button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
