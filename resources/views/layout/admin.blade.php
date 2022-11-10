
<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>Traveling Bee</title>


<link rel="icon" href="{{ url('favicon/favicon.png') }}">

@vite('resources/css/app.css') 
</head>

<body class="layout-fixed  sidebar-closed sidebar-collapse sidebar-mini-xs">



<div id="app"></div>
@vite('resources/js/app.js') 
{{-- <script src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7)></script>  --}}
</body>
</html>
