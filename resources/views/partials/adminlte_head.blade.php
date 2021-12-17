<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex,nofollow">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- Styles -->
    {{ Html::style('css/app.css') }} 
    {{ Html::style('bootstrap5/css/bootstrap.min.css') }}
    <!-- Toastr CSS -->
    @toastr_css
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- Custom Styles -->
    <style>
        html, body {height: 100%;}            
        body {margin: 0;padding: 0;width: 100%;display: table;font-weight: 100;font-size: 16px;font-family: 'Lato';} 
        .card{margin-top: 70px;margin-bottom: -30px}
        .navbar { border-radius: 0;width: 100%; padding: 0 20px; z-index: 100; }
        .footer{position: fixed;left: 0;bottom: 0;width: 100%;background-color: red;color: white;text-align: center;}
    </style>
</head>