<!DOCTYPE html>
<html lang="cn">
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    </head>
    <body>
        @yield('content')

        <script type="text/javascript" src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
        <script>
			var _hmt = _hmt || [];
			(function() {
			  var hm = document.createElement("script");
			  hm.src = "//hm.baidu.com/hm.js?4c7136d8d9342c4f5ae909bcf2cdee7f";
			  var s = document.getElementsByTagName("script")[0]; 
			  s.parentNode.insertBefore(hm, s);
			})();
		</script>
    </body>
</html>
