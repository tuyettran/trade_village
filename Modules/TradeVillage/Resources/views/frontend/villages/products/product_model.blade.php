<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productIndex.css') }}">

	{!! Theme::script('library/js/jquery-3.2.1.min.js') !!}
	<link href="{{ URL::asset('axZm/axZm.css') }}" type="text/css" rel="stylesheet" />

    {!! Theme::script('library/js/bootstrap.min.js') !!}

    {!! Theme::style('library/css/bootstrap.min.css') !!}
    {!! Theme::style('css/style.css') !!}
</head>
<body>
	<div class="custom-container">
		<div><h2 class="center">{{ $product->translate(locale())->name }}</h2></div>
		<div class="col-md-12">
			<div id="AZplayerParentContainer" style="height: 700px; width: 100%; overflow: hidden; z-index: 1; position: relative;"></div>
			
		</div>
	</div>

	<p id="app_url" style="display: none">{{ env('APP_URL') }}</p>

	<script type="text/javascript" src="{{ URL::asset('axZm/jquery.axZm.js') }}"></script>

	<script type="text/javascript">
		var url = $('#app_url').html();
		window.ajaxZoom = {};
			var callbacks = {
					onBeforeStart: function(){
						// Some of the options can be set directly as js var in this callback, e.g. 
						jQuery.axZm.spinReverse = true;
						// jQuery.axZm.spinReverseZ = true;
					},

					onLoad: function(){
						jQuery.axZm.fullScreenExitText = false;
					}
				}

				$.fn.axZm.openResponsive(
					url+'/axZm/', // Absolute path to AJAX-ZOOM directory, e.g. '/axZm/'
					// {{env('APP_URL')}}.'/axZm/'
					'example=17&3dDir='+url+'/product/models/'+ {{ $product->id }}, // Defines which images and which options set to load
					{}, // callbacks
					'AZplayerParentContainer', // target - container ID (default 'window' - fullscreen)
					false, // apiFullscreen- use browser fullscreen mode if available
					true, // disableEsc - prevent closing with Esc key
					false // postMode - use POST instead of GET
				);
            $('.super-header').hide();

		</script>
		
</body>
</html>