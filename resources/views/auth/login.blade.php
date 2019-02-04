<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login logiSmart</title>
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
<!--STYLESHEETS-->
<link href="{{ asset('css/bootstrap4.min.css') }}" rel="stylesheet" id="bootstrap-css">
<script src="{{ asset('js/bootstrap4.min.js') }}"></script>

<!--SCRIPTS-->
<script type="text/javascript" src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
<style>

    .login-block{
        background: #DE6262;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to bottom, #021c4e, #ffffff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        float:left;
        width:100%;
        padding : 50px 0;
    }
    .banner-sec{background:url({{ asset('img/portada1.jpg') }})  no-repeat left bottom; background-size:cover; min-height:450px; border-radius: 0 10px 10px 0; padding:0;}
    .container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1);}
    .carousel-inner{border-radius:0 10px 10px 0;}
    .carousel-caption{text-align:left; left:5%;}
    .login-sec{padding: 50px 30px; position:relative;}
    .login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
    .login-sec .copy-text i{color:#FEB58A;}
    .login-sec .copy-text a{color:#E36262;}
    .login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #3e86bf;}
    .login-sec h2:after{content:" "; width:100px; height:5px; background:#3e86bf; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
    .btn-login{background: #DE6262; color:#fff; font-weight:600;}
    .banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;background-color: #aadd7759}
    .banner-text h2{color:#fff; font-weight:600;}
    .banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
    .banner-text p{color:#fff;}


</style>
</head>
<body>

<section class="login-block">
    <div class="container">
        <div class="row">
            <div class="col-md-4 login-sec">
                <h2 class="text-center">Logística y Almacén <small>LogiSmart v2019</small></h2>

                <form class="login-form" method="POST" name="login-form" action="{{ asset('/auth/login') }}">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-uppercase">Usuario</label>
                        <input name="usrID" autocomplete="off" autofocus type="text" class="form-control" placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="text-uppercase">Contraseña</label>
                        <input name="password" autocomplete="off" type="password" class="form-control" placeholder="">
                    </div>


                    <div class="form-check">
                        {{--<label class="form-check-label">--}}
                            {{--<input type="checkbox" class="form-check-input">--}}
                            {{--<small>Remember Me</small>--}}
                        {{--</label>--}}
                        <button type="submit" name="submit" class="btn btn-login float-right">Ingresar</button>
                    </div>

                </form>
                <div class="copy-text"> Municipalidad Distrital de Quellouno </div>
            </div>
            <div class="col-md-8 banner-sec">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="{{ asset('img/portada1.jpg') }}" alt="First slide">
                            {{--<div class="carousel-caption d-none d-md-block">--}}
                                {{--<div class="banner-text">--}}
                                    {{--<h2>This is Heaven</h2>--}}
                                    {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script>

    $.extend($.expr[':'],{
        focusable: function (el, index, selector) {
            return $(el).is('a, button, :input, [tabindex]');
        }
    });

    $(document).on('keypress', 'input,select', function (e) {
        if (e.which === 13) {
            e.preventDefault();
            // Get all focusable elements on the page
            var $canfocus = $(':focusable');
            var pindex = $canfocus.index(document.activeElement) * 1;
            var index = $canfocus.index(document.activeElement) + 1;
            // alert('act: ' + pindex + ' - next: ' + index);
            if (index >= $canfocus.length) index = 0;
            $canfocus.eq(index).focus();
        }
    });
</script>

</body>
</html>