<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Freelancer - Start Bootstrap Theme</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{URL::asset('css/freelancer.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{URL::asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    {{--<link rel="stylesheet" type="text/css" href="{{URL::asset('css/normalize.css')}}" />--}}
    {{--<link rel="stylesheet" type="text/css" href="{{URL::asset('css/demo.css')}}" />--}}
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/component.css')}}" />
</head>
<body id="page-top" class="index">
	<nav class="navbar navbar-default navbar-fixed-top navbar-shrink">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">CLB-Chung Khoan</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll active">
                        <a href="#login">Login</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">Review</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#result">Result</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
	        <!-- /.container-fluid -->
    </nav>
    @yield('section')
    {{--load libaries--}}
    {{--jQuery--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    {{--jQuery-UI to-handle this.easing-error--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
    {{--bootstrap-js--}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{--style radio button--}}
    <script src="{{URL::asset('js/svgcheckbx.js')}}"></script>
    {{-- Plugin JavaScript --}}
    <script src="{{URL::asset('js/classie.js')}}"></script>
    <script src="{{URL::asset('js/cbpAnimatedHeader.js')}}"></script>

    {{--Contact Form JavaScript--}}
    <script src="{{URL::asset('js/jqBootstrapValidation.js')}}"></script>
    <script src="{{URL::asset('js/contact_me.js')}}"></script>

   {{--Custom Theme JavaScript--}}
    <script src="{{URL::asset('js/freelancer.js')}}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
        $(document).ready(function(){
            var message = "";
            $('#page_messages').find(':input').each(function(){
                message += $(this).val() + "\n";
            });console.log(message);
            if(message != ""){
                alert(message);
            }
        });
    </script>
    @yield('project_script')
</body>
<footer class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">
                <div class="footer-col col-md-4">
                    <h3>Location</h3>
                    <p>3481 Melrose Place<br>Beverly Hills, CA 90210</p>
                </div>
                <div class="footer-col col-md-4">
                    <h3>Around the Web</h3>
                    <ul class="list-inline">
                        <li>
                            <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-dribbble"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="footer-col col-md-4">
                    <h3>About Freelancer</h3>
                    <p>Freelance is a free to use, open source Bootstrap theme created by <a href="http://startbootstrap.com">Start Bootstrap</a>.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    Copyright © Your Website 2014
                </div>
            </div>
        </div>
    </div>
</footer>
<div id="page_messages">
@if(is_array($messages))
    @foreach($messages as $key => $values)
        @if(is_array($values))
            @foreach($values as $value)
                <input type="hidden" name="{{$key}}" value="{{$value}}">
            @endforeach
        @else
            <input type="hidden" name="{{$key}}" value="{{$values}}">
        @endif
    @endforeach
@else
    <input type="hidden" name="messages" value="{{$messages}}">
@endif
</div>
</html>