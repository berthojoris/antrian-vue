<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Antrian</title>
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/skel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body {
			background: #F5F5F5;
        }
        body, input, select, textarea {
            font-size: 11pt;
        }
		.wrapper {
			padding: 2em 0em 4em;
		}
    </style>
</head>
<body class="landing">
    <div id="app">
        @yield('content')
    </div>
</body>
</html>