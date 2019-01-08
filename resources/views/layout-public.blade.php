<!DOCTYPE html>
<html>

@include('partials.htmlheader')

<body style="padding-top: 50px">
	<div class="alm-wrapper">
        <div class="alm-content-wrapper">
            @yield('main-content')
        </div>
	</div>
	@include('partials.scripts')
</body>
</html>