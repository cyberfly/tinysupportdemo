<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TinySupport</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }

        /*Comment List styles*/
        .comment-list .row {
            margin-bottom: 0px;
        }
        .comment-list .panel .panel-heading {
            padding: 4px 15px;
            position: absolute;
            border:none;
            /*Panel-heading border radius*/
            border-top-right-radius:0px;
            top: 1px;
        }
        .comment-list .panel .panel-heading.right {
            border-right-width: 0px;
            /*Panel-heading border radius*/
            border-top-left-radius:0px;
            right: 16px;
        }
        .comment-list .panel .panel-heading .panel-body {
            padding-top: 6px;
        }
        .comment-list figcaption {
            /*For wrapping text in thumbnail*/
            word-wrap: break-word;
        }
        /* Portrait tablets and medium desktops */
        @media (min-width: 768px) {
            .comment-list .arrow:after, .comment-list .arrow:before {
                content: "";
                position: absolute;
                width: 0;
                height: 0;
                border-style: solid;
                border-color: transparent;
            }
            .comment-list .panel.arrow.left:after, .comment-list .panel.arrow.left:before {
                border-left: 0;
            }
            /*****Left Arrow*****/
            /*Outline effect style*/
            .comment-list .panel.arrow.left:before {
                left: 0px;
                top: 30px;
                /*Use boarder color of panel*/
                border-right-color: inherit;
                border-width: 16px;
            }
            /*Background color effect*/
            .comment-list .panel.arrow.left:after {
                left: 1px;
                top: 31px;
                /*Change for different outline color*/
                border-right-color: #FFFFFF;
                border-width: 15px;
            }
            /*****Right Arrow*****/
            /*Outline effect style*/
            .comment-list .panel.arrow.right:before {
                right: -16px;
                top: 30px;
                /*Use boarder color of panel*/
                border-left-color: inherit;
                border-width: 16px;
            }
            /*Background color effect*/
            .comment-list .panel.arrow.right:after {
                right: -14px;
                top: 31px;
                /*Change for different outline color*/
                border-left-color: #FFFFFF;
                border-width: 15px;
            }
        }
        .comment-list .comment-post {
            margin-top: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
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
                <a class="navbar-brand" href="{{ url('/') }}">
                    TinySupport
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    <li><a href="{{ route('tickets.index') }}">Tickets</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
