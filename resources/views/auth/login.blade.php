<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Form</title>

<!--STYLESHEETS-->
<link href="{{asset('css/style-login.css')}}" rel="stylesheet" type="text/css" />

<!--SCRIPTS-->
<script type="text/javascript" src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
<!--Slider-in icons-->
<script type="text/javascript">
$(document).ready(function() {
	$(".username").focus(function() {
		$(".user-icon").css("left","-48px");
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","0px");
	});
	
	$(".password").focus(function() {
		$(".pass-icon").css("left","-48px");
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","0px");
	});
});
</script>

</head>
<body>

<!--WRAPPER-->
<div id="wrapper">

	<!--SLIDE-IN ICONS-->
    <div class="user-icon"></div>
    <div class="pass-icon"></div>
    <!--END SLIDE-IN ICONS-->

<!--LOGIN FORM-->
<form method="POST" name="login-form" class="login-form" action="{{ asset('/auth/login') }}">
	{!! csrf_field() !!}

	<!--HEADER-->
    <div class="header">
    <!--DESCRIPTION--><p align="center" ><span>{{ config('slam.ENTIDAD_PIE') }}</span></p><br><!--END DESCRIPTION-->
    <!--TITLE--><h4 ALIGN="CENTER">Sistema de Logistica <BR>  Almacen<BR> </h4><br><!--END TITLE-->
    <!--TITLE--><h4 ALIGN="CENTER">{{ config('slam.VERSION') }}</h4><!--END TITLE-->

    </div>
    <!--END HEADER-->
	
	<!--CONTENT-->
    <div class="content">
		<input name="usrID" type="text" autocomplete="off" class="input username" placeholder="Usuario" onfocus="this.value=''" />
	    <input name="password" type="password" autocomplete="off" class="input password" placeholder="Contraseña" onfocus="this.value=''" />
    </div>
    <!--END CONTENT-->
    <!--FOOTER-->
    <div class="footer">
    	<input type="submit" name="submit" value="Entrar" class="button" />

    </div>
    <!--END FOOTER-->

	
	
	
</form>
<!--END LOGIN FORM-->

</div>
<!--END WRAPPER-->

<!--GRADIENT--><div class="gradient"></div><!--END GRADIENT-->

</body>
</html>