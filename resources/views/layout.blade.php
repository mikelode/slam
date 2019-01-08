<!DOCTYPE html>
<html>

@include('partials.htmlheader')

<body>
	<div class="alm-wrapper">
	    <div id="ribbon">
    	    @include('partials/mainheader')
	    </div>
        <div class="alm-content-wrapper">
            @yield('main-content')
        </div>
        <div id = "loadModalsMain" > </div>
		<input type="hidden" name="_token" value="{{csrf_token()}}" id ="tokenBtnMain">
	</div>
	@include('partials.scripts')




</body>
</html>