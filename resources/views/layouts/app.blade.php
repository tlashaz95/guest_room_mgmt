<!DOCTYPE html>
<html>

<head>

    <title>{{env("APP_NAME")}}</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Bootstrap Core Css -->
    <link href="{{url('theme')}}/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
{{--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>--}}
    <script src="{{url('theme')}}/js/bootstrap.min.js"></script>
    <script src="{{url('theme')}}/js/bootstrap.js"></script>
    <script src="{{url('theme')}}/js/jquery.min.js"></script>

    <!-- Waves Effect Css -->
    <link href="{{url('theme')}}/plugins/node-waves/waves.css" rel="stylesheet"/>

    <!-- Animation Css -->
    <link href="{{url('theme')}}/plugins/animate-css/animate.css" rel="stylesheet"/>
    <link href="{{url('theme')}}/plugins/select2/css/select2.css" rel="stylesheet"/>

    <!-- Morris Chart Css-->
    <link href="{{url('theme')}}/plugins/morrisjs/morris.css" rel="stylesheet"/>

    <!-- Custom Css -->
    <link href="{{url('theme')}}/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{url('theme')}}/css/themes/all-themes.css" rel="stylesheet"/>

<!-- <script src="{{url('theme/js/jquery-3.3.1.min.js')}}"></script> -->

    <script src="{{asset('js/canvasjs.min.js')}}"></script>

    <link rel="stylesheet" href="{{url('theme')}}/css/w3.css">
    <link rel="stylesheet" href="{{url('theme')}}/css/selectize.bootstrap3.min.css">
    {{--    <link rel="stylesheet" href="{{url('theme')}}/css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="{{url('theme')}}/css/tabs.css">

    <style>
        .btn-delete {
            background: transparent !important;
            border: 0px !important;
            margin: 0px;
            padding: 0px;
            box-shadow: transparent !important;
        }

        table tr td, th {
            font-size: small;
            padding: 2%;
        }

        table {
            padding: 1%;
        }

        table .action-td a, button, span {
            font-size: 16px !important;
        }

        .row-number {
            color: black;
            padding: 5px;
            font-weight: bold;
        }

        .img-responsive {
            width: 100%;
            height: auto;
        }

        .form-card {
            padding-right: 2%;
            padding-left: 2%;
            padding-top: 3%;
            padding-bottom: 3%;
        }

        form label {
            font-size: 1.1em;
        }

        input {
            font-size: 1.1em !important;
        }

        .selectize-input {
            min-width: 70px !important;
        }

        /*.selectize-input input{*/
        /*    height: 30px !important;*/
        /*}*/

        .w3-allerta {
            font-family: "Allerta Stencil", Sans-serif;
        }

        .op_projects {
            border-radius: 10px;
            border: 1px solid #2d2d2d;
            background-color: #3c3c3c;
            color: whitesmoke;
            text-align: center;
            margin: 1%;
            margin-left: 5%;
        }

        .sliderImg {
            height: 220px !important;
            min-width: 350px !important;
        }

        .facilities {
            border-radius: 10px;
            border: 1px solid #2d2d2d;
            background-color: #660000;
            color: whitesmoke;
            text-align: center;
            height: 50px;
            margin: 0.3%;
        }

        .canvasjs-chart-credit {
            visibility: hidden !important;
        }

        .mandatory {
            color: red;
        }

        .paid {
            font-size: 14px;
            font-weight: 600;
            color: darkgreen;
        }

        .bal {
            font-size: 14px;
            font-weight: 600;
            color: darkred;
        }
    </style>
    <script>

        // $(document).ready(
        // function(){
        //     $('select').select2();
        // });
        function confirm_link() {
            let c = 0;
            if (!confirm('Are you sure to proceed?')) {
                event.preventDefault();
            }
        }

        //
        // $(document).ready(function () {
        //     $(".pop-up").fadeTo(2000, 500).slideUp(500, function () {
        //         $(".pop-up").slideUp(500);
        //     })
        // });


    </script>
</head>

<body style="background-image: url('theme/images/Napier.png'); z-index: 9999">
<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid center-align">
        <div class="navbar-header w3-allerta w3-center" style="width: 100%">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
               data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <img src="{{url('theme')}}/images/Div.png" height=85" width="90"
                 style="float: left; vertical-align: center"/>
            <a class="navbar-brand w3-xxlarge" style="margin-top:1%; font-family: 'Candara'; margin-left: 1px"
               href="{{url('home')}}">{{strtoupper(env("APP_NAME"))}}</a>
        </div>
    </div>
</nav>
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar" style="margin-top: 2.2%; background: #c0c0c0">

        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li>
                    <h6 class="profile-body" style="margin: 10% 0 0 15%; color: black">
                        <u>{{Auth::user()->email}}</u>
                    </h6>
                </li>

                <li>
                    <a href="{{url('bookings/index')}}">
                        <span>Checkin / Checkouts</span>
                    </a>
                </li>

                <!-- <li class="">
                    <a href="{{route('full-calendar')}}">
                        <span>Bookings</span>
                    </a>
                </li> -->

                <li class="">
                    <a href="{{route('rooms')}}">
                        <span>Rooms</span>
                    </a>
                </li>

                @if(Auth::user()->role == "admin")
                    <li class="">
                        <a href="{{route('billing')}}">
                            <span>Bills</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span>Reports</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{route('dailyReports')}}">
                                    <span>Daily</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('weeklyReports')}}">
                                    <span>Weekly</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('reports')}}">
                                    <span>Monthly</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="">
                        <a href="{{route('user')}}">
                            <span>Users</span>
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{url('changePassword')}}">
                        <span>Change Password</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                <li>
                    <a href="">
                        <span></span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- #Menu -->
    </aside>
    <!-- #END# Left Sidebar -->

</section>
<section class="content">
    @include('layouts.alerts')
    <div class="container-fluid p-r-0">
        <main class="row py-4">
            <div class="col-lg-12 m-t-70">
                @if(Auth::user()->pwd_changed == "0")
                    <div class="alert alert-danger">
                        Kindly change your default password <a href="{{url('changePassword')}}"><i><u>here</u></i></a>
                    </div>
                @endif
                {{--                <div class="m-t-30 h2 text-dark" style="text-align: center">{{strtoupper($module ?? '')}}</div>--}}
                @yield('content')
            </div>

        </main>
    </div>
    @include('layouts.footer')
</section>

<!-- Bootstrap Core Js -->
<link rel="stylesheet" type="text/css" href="{{url('js')}}/DataTables/datatables.min.css"/>

<script type="text/javascript" src="{{url('js')}}/DataTables/datatables.min.js"></script>
<script !src="">
    $(document).ready(function () {
        $('.datatable').DataTable();
    });
</script>
<!-- Select Plugin Js -->
{{--<script src="{{url('theme')}}/plugins/bootstrap-select/js/bootstrap-select.js"></script>--}}

<!-- Slimscroll Plugin Js -->
<script src="{{url('theme')}}/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{url('theme')}}/plugins/node-waves/waves.js"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="{{url('theme')}}/plugins/jquery-countto/jquery.countTo.js"></script>

<!-- Morris Plugin Js -->
<script src="{{url('theme')}}/plugins/raphael/raphael.min.js"></script>
<script src="{{url('theme')}}/plugins/morrisjs/morris.js"></script>

<!-- ChartJs -->
<script src="{{url('theme')}}/plugins/chartjs/Chart.bundle.js"></script>

<!-- Custom Js -->
<script src="{{url('theme')}}/js/print.js"></script>
<script src="{{url('theme')}}/js/admin.js"></script>
<script src="{{url('theme')}}/js/pages/index.js"></script>

<!-- Demo Js -->
<script src="{{url('theme')}}/js/demo.js"></script>

<script src="{{url('theme')}}/js/select2.full.js"></script>

<script src="{{url('theme')}}/js/selectize.min.js"></script>

<script>
    // Block Special Chars
    function alphaNumericOnly(e) {
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
    }

    // Block Special Chars and Numbers
    function alphabetsOnly(e) {
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32);
    }

    // Nos only
    function NumericOnly(e) {
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k >= 48 && k <= 57));
    }

    $(document).ready(function () {
        //Initialize Select2 Elements
        $('select2').select2();

    });

    $("form").submit(function () {
        setTimeout(hideError, 5000);
    });

    $("a").click(function () {
        setTimeout(hideError, 5000);
    });

    var hideError = function () {
        $(".alert").hide();
    };
</script>

<script>
    $(document).ready(function () {
        var selectize = $('select.form-control').selectize({
            sortField: 'text',
            keyPress: function () {
                alert('ok')
            }

        });
        // selectize.on('keyPress', function(){
        //     alert('ok')
        // });
    });


    // Block Special Chars in selectize fds
    $("input[type=select-one]").on('keypress', function (e) {
        var k;
        document.all ? k = e.keyCode : k = e.which;
        console.log('ok');
        return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 45 || k == 32 || (k >= 48 && k <= 57));
    });

    $("#Sldr-selectized").on('load', function () {
        alert('ok')
    })


</script>

@yield('js')
</body>

</html>
