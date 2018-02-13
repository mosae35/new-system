<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pagination.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-1.11.3.min.js') }}" ></script>
    <script src="{{ asset('js/entrey_process.js') }}" ></script>
    <script src="{{ asset('js/out_process.js') }}" ></script>
</head>
<body style="direction: rtl;">

    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" style="    background-color: #ffffff61;
             border-color: #a2adbb;">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        <span style="font-size: 23px;color: white;">المتحدة</span>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a style="color: #ffffff;font-size: 18px;" href="{{ route('login') }}">تسجيل الدخول </a></li>
                            <li><a style="color: #ffffff;font-size: 18px;" href="{{ route('register') }}"> التسجيل </a></li>
                        @else

                            <li >
                                <a href="{{url('home')}}"  style="color:black;font-size: 18px;">
                                    <span>الرئيسيه</span>
                                </a >

                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" style="color:black;font-size: 18px;"
                                   data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span>الاقسام</span> <span class="caret"></span>
                                </a >

                                <ul class="dropdown-menu" role="menu" >

                                    <li style="text-align: center; ">
                                        <a style="font-size: 18px;"
                                           href="{{url('/process')}}"> <span > العمل اليومى  </span></a>
                                    </li>

                                    <li style="text-align: center;">
                                        <a style="font-size: 18px;"
                                           href="{{url('/out_process')}}"> <span > العمل الخارجى  </span></a>
                                    </li>
                                    <li style="text-align: center;">
                                        <a style="font-size: 18px;"
                                           href="{{url('/insert_account')}}"> <span > الحسابات الداخليه </span></a>
                                    </li>
                                    <li style="text-align: center;">
                                        <a style="font-size: 18px;"
                                           href="{{url('/out_account')}}"> <span > الحسابات الخارجيه </span></a>
                                    </li>
                                    <li style="text-align: center;">
                                        <a style="font-size: 18px;"
                                           href="{{url('/remain_payment')}}"> <span > حسابات التعاقدات  </span></a>
                                    </li>

                                    <li style="text-align: center; ">
                                        <a style="font-size: 18px;"
                                           href="{{url('/employ')}}"> <span > حسابات العاملين </span></a>
                                    </li>
                                    <li style="text-align: center;">
                                        <a style="font-size: 18px;"
                                           href="{{url('/store')}}"> <span > المخزن </span></a>
                                    </li>

                                    <li style="text-align: center;">
                                        <a style="font-size: 18px;"
                                           href="{{url('/out_store')}}"> <span > المخزن الخارجى </span></a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" style="color:black;font-size: 18px;"
                                   data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span>المستخدمون</span> <span class="caret"></span>
                                </a >

                                <ul class="dropdown-menu" role="menu">
                                    <li style="text-align: center; ">
                                        <a style="font-size: 18px;"
                                           href="{{url('/user')}}"> <span > الاعضاء </span></a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" style="color:black;font-size: 18px;"
                                   data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span>المستلزمات</span> <span class="caret"></span>
                                </a >

                                <ul class="dropdown-menu" role="menu">
                                    <li style="text-align: center;">
                                        <a style="font-size: 18px;"
                                           href="{{url('machien')}}"><span> المستلزمات </span></a>
                                    </li>
                                    <li style="text-align: center;">
                                        <a style="font-size: 18px;"
                                                href="{{url('/requirement')}}"> <span > ألات </span></a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" style="color:black;font-size: 18px;"
                                   data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            تسجيل الخروج
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>

            </div>
        </nav>


        <div class="container" style="margin-bottom: 100px;">
        @yield('content')
        </div>


        <!-- footer  -->
        <footer>
            <p> <a style="color:#0a93a6; text-decoration:none;"
                        href="https://www.facebook.com/mo.sa.5245"> Eslam Mosa Developer</a> <span>© 2017</span> , All rights reserved 2016-2017.</p>
        </footer>


    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/nav.js') }}"></script>
</body>
</html>
