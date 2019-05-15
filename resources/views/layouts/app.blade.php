<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>System for Agricultural Local Entrepreneur</title>

    <link href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    @section('css-top')
    @show

    <!-- Toastr style -->
    <link href="{{ asset('vendor/toastr/toastr.min.css') }}" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="{{ asset('vendor/sweetalert/sweetalert.css') }}" rel="stylesheet">


    <link href="{{ asset('vendor/animate/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @section('css-bot')
    @show

</head>

<body class="skin-3">

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{ asset('img/avatar') }}/{{ Auth::user()->img }}" width="75px" height="75px" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</strong>
                            </span>  </a>
                        
                    </div>
                    <div class="logo-element">
                        SALE
                    </div>
                </li>

                <li @if(strpos(url()->current(), request()->getHttpHost().'/seller') == true) class="active" @endif>
                    <a href="javascript:void(0)"><i class="fa fa-user"></i> <span class="nav-label">Seller</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li @if(strpos(url()->current(), request()->getHttpHost().'/seller/list') == true) class="active" @endif><a href="/seller/list">Seller List</a></li>
                        <li @if(strpos(url()->current(), request()->getHttpHost().'/seller/add') == true) class="active" @endif><a href="/seller/add">Add Seller</a></li>
                    </ul>
                </li>

                <li @if(strpos(url()->current(), request()->getHttpHost().'/producer') == true) class="active" @endif>
                    <a href="javascript:void(0)"><i class="fa fa-lemon-o"></i> <span class="nav-label">Producer</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li @if(strpos(url()->current(), request()->getHttpHost().'/producer/list') == true) class="active" @endif><a href="/producer/list">Producer List</a></li>
                        <li @if(strpos(url()->current(), request()->getHttpHost().'/producer/add') == true) class="active" @endif><a href="/producer/add">Add Producer</a></li>
                       
                    </ul>
                </li>

                <li @if(strpos(url()->current(), request()->getHttpHost().'/dealer') == true) class="active" @endif>
                    <a href="/dealer"><i class="fa fa-truck"></i> <span class="nav-label">Dealer</span></a>
                </li>

                <li @if(strpos(url()->current(), request()->getHttpHost().'/category') == true) class="active" @endif>
                    <a href="/category"><i class="fa fa-bars"></i> <span class="nav-label">Category</span></a>
                </li>

                <li @if(strpos(url()->current(), request()->getHttpHost().'/product') == true) class="active" @endif>
                    <a href="/product"><i class="fa fa-leaf"></i> <span class="nav-label">Product</span></a>
                </li>

                <li @if(strpos(url()->current(), request()->getHttpHost().'/settings') == true) class="active" @endif>
                    <a href="index.html"><i class="fa fa-cog"></i> <span class="nav-label">Settings</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li @if(strpos(url()->current(), request()->getHttpHost().'/settings/profile') == true) class="active" @endif><a href="/settings/profile">Profile</a></li>
                        <li @if(strpos(url()->current(), request()->getHttpHost().'/settings/account') == true) class="active" @endif><a href="/settings/account">Add Admin</a></li>
                        <li @if(strpos(url()->current(), request()->getHttpHost().'/settings/logs') == true) class="active" @endif><a href="/settings/logs">Log-in Log</a></li>
                    </ul>
                </li>
                
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">

            <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <ul class="nav navbar-top-links navbar-left">
                
                <li>
                    <a href="javascript:void(0)">
                        System for Agricultural Local Entrepreneur
                    </a>
                </li>
            </ul>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                
                <li>
                    <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading hidden-print">
                <div class="col-sm-4">
                    <h2>@yield('page-title')</h2>
                    <ol class="breadcrumb">
                        @section('breadcrumb')
                        @show
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                        @yield('page-button')
                    </div>
                </div>
            </div>

            <div class="wrapper wrapper-content">
                @section('main-section')
                @show
            </div>
            <div class="footer hidden-print">
                <div class="pull-right">
                    {{ request()->getHttpHost() }}
                </div>
                <div>
                    System for Agricultural Local Entrepreneur &copy; {{ date('Y', time()) }}
                </div>
            </div>

        </div>
        </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('vendor/jquery/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('vendor/slimscroll/jquery.slimscroll.min.js') }}"></script>

    @section('js-top')
    @show

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('vendor/pace/pace.min.js') }}"></script>

    <!-- Toastr script -->
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>

    <!-- Sweet alert -->
    <script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>

    <script type="text/javascript">
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>
    

    @section('js-bot')
    @show


</body>

</html>
