<!DOCTYPE html>
<html>
<head lang="{{ LaravelLocalization::setLocale() }}">
    <meta charset="UTF-8">
    @section('meta')
        <meta name="description" content="@setting('core::site-description')" />
    @show
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @section('title')@setting('core::site-name')@show
    </title>
    <link rel="shortcut icon" href="{{ Theme::url('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    {!! Theme::style('css/style.css') !!}
    {!! Theme::style('css/header_footer.css') !!}
    {!! Theme::style('library/css/bootstrap.min.css') !!}

    @yield('style')
</head>
<body>
    
    @include('partials.header')
    @include('partials.navigation')

    <div class="custom-container">
        @yield('content')
    </div>
    @include('partials.footer')

<!--     {!! Theme::script('js/all.js') !!} -->
    <script src="//cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    {!! Theme::script('library/js/jquery-3.2.1.min.js') !!}
    {!! Theme::script('library/js/bootstrap.min.js') !!}
    @yield('scripts')

    <?php if (Setting::has('core::analytics-script')): ?>
        {!! Setting::get('core::analytics-script') !!}
    <?php endif; ?>

        <script type="text/javascript">
            $(window).scroll(function(e){ 
            var $el = $('.super-header'); 

            if ($(this).scrollTop() > 200){ 
                    $('.navbar').addClass("navbar-fixed-top");
                }
            if ($(this).scrollTop() < 200){
                    $('.navbar').removeClass("navbar-fixed-top");
            } 
        }); 
    </script>
    <script src="{{ URL::asset('ckeditor/ckeditor.js') }}"></script>
    <script> CKEDITOR.replaceAll('editor1'); </script>
</body>
</html>
