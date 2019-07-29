<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Room Booking Sekolah Vokasi UGM</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    @yield('css')
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-image="/img/sidebar-1.jpg">           
            <div class="logo">
                <a href="{{route('welcome')}}" class="simple-text">
                    Room Booking
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="{{ active('home') }}">
                        <a href="{{route('home')}}">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="{{ active('get.room') }}">
                        <a href="{{route('get.room')}}">
                            <i class="material-icons">person</i>
                            <p>Ruangan</p>
                        </a>
                    </li>
                    <li class="{{ active('get.agenda') }}">
                        <a href="{{route('get.agenda')}}">
                            <i class="material-icons">content_paste</i>
                            <p>Agenda</p>
                        </a>
                    </li>                

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    <li class="active-pro">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            <i class="material-icons">power_settings_new</i>
                            <p>Keluar</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>                        
                    </div>                    
                    <a class="navbar-brand" href="#"> @yield('title-header') </a>
                </div>
            </nav>
            <div class="content">
        @yield('content')
        <footer class="footer">
                <div class="container-fluid">                    
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="http://www.durenmedia.net">MRFSHDQ</a> made with <3
                    </p>
                </div>
            </footer>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/js/material.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="/js/chartist.min.js"></script>
<!--  Dynamic Elements plugin -->
<script src="/js/arrive.min.js"></script>
<!--  PerfectScrollbar Library -->
<script src="/js/perfect-scrollbar.jquery.min.js"></script>
<!--  Notifications Plugin    -->
<script src="/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<!-- Material Dashboard javascript methods -->
<script src="/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
@yield('js')

</html>