<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <script rel="text/javascript">
        $(document).ready(function(){
            $('.toggle').click(function(){
                $('.toggle').toggleClass('active');
                $('ul').toggleClass('active');
            });
        });
    </script>
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
        body {
            margin:0;
            padding:0;
            background:#003030;
        }
        .share {
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%,-50%) rotate(45deg);
            width:80px;
            height:80px;
        }
        .share ul {
            position:relative;
            margin:0;
            padding:0;
            width:100%;
            height:100%;
        }
        .share ul li {
            position:absolute;
            top:0;
            left:0;
            list-style:none;
            width:100%;
            height:100%;
            border-radius:10px;
            background:#fff;
            transition:0.5s;
            overflow:hidden;
        }
        .share ul.active li {
            transform:scale(0.95);
        }
        .share ul li a {
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
            line-height:80px;
            text-align:center;
            font-size:30px;
            color:#2196f3;
            transition:.5s;
        }
        .share ul li a .fa {
            transform:rotate(-45deg);
        }
        .share ul li a:hover {
            color:#fff;
            background:#2196f3;
        }
        .share ul.active li:nth-child(1){
            top:-100%;
            left:-100%;
            transition-delay:0s;
        }
        .share ul.active li:nth-child(2){
            top:-100%;
            left:0;
            transition-delay:0.2s;
        }
        .share ul.active li:nth-child(3){
            top:-100%;
            left:100%;
            transition-delay:0.4s;
        }
        .share ul.active li:nth-child(4){
            top:0;
            left:100%;
            transition-delay:0.6s;
        }
        .share ul.active li:nth-child(5){
            top:100%;
            left:100%;
            transition-delay:0.8s;
        }
        .share ul.active li:nth-child(6){
            top:100%;
            left:0;
            transition-delay:1s;
        }
        .share ul.active li:nth-child(7){
            top:100%;
            left:-100%;
            transition-delay:1.2s;
        }
        .share ul.active li:nth-child(8){
            top:0;
            left:-100%;
            transition-delay:1.4s;
        }
        .toggle {
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:#e91e63;
            transform:scale(0.95);
            overflow:hidden;
            border-radius:10px;
            z-index:1;
            cursor:pointer;
        }
        .toggle:before {
            content:'\f1e0';
            font-family:fontAwesome;
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
            text-align:center;
            line-height:80px;
            color:#fff;
            font-size:30px;
            transform:rotate(-45deg);
        }

        .toggle.active:before {
            content:'\f00d';
        }



    </style>
</head>
<body>



<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    registrarse
                </button>
            @endauth
        </div>
    @endif

    @include('frontend.modals.registermodal')


    <div class="content">

        <div class="links">
            <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <!------ Include the above in your HEAD tag ---------->

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <div class="share">
                <div class="toggle"></div>
                <ul>
                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                </ul>
            </div>



            <a href="https://github.com/TomasRebot">GitHub</a>
        </div>
    </div>
</div>
</body>
</html>
