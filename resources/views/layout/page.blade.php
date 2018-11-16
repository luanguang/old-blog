<!doctype html>
<html>
<head>
    <meta charset="utf-8">

    <!-- TITLE OF SITE -->
    <title>欢乐日常</title>

    <!-- META DATA -->
    <meta name="description" content="欢乐日常" />
    <meta name="keywords" content="the reader, blog, html5, minimal blog" />
    <meta name="author" content="Luan Guang">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- =========================
      FAV AND TOUCH ICONS
    ============================== -->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/images/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/images/apple-touch-icon-114x114.png') }}">

    <!-- =========================
       STYLESHEETS
    ============================== -->
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700' rel='stylesheet'>

    <!-- FLAT ICON -->
    <link href='{{ asset('assets/css/flaticon.css') }}' rel='stylesheet'>
    <link href='{{ asset('assets/css/nprogress.css') }}' rel='stylesheet'>

    <!-- MEDIA ELEMENT AND PLAYER -->
    <link rel="stylesheet" href="{{ asset('assets/css/mediaelementplayer.css') }}">

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">


    <link rel="stylesheet" href="{{ asset('assets/css/colors/nephritis.css') }}">


    <!-- RESPONSIVE FIXES -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

    <!--[if lt IE 9]>
    <script src="{{ asset('assets/js/html5shiv.js') }}"></script>
    <script src="{{ asset('assets/js/respond.min.js') }}"></script>
    <![endif]-->

</head>
<body>

@include ('layout.header')


<!-- BODY CONTAINER -->

        <!-- =========================
             BLOG SECTION
        ============================== -->
       @yield ('content')
        <!-- /END BLOG SECTION -->



 <!-- end of .container-fluid -->

<script src="{{ asset('assets/js/jquery.1.9.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/mediaelement-and-player.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.fitvids.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

</body>
</html>