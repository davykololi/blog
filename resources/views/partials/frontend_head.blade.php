<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-language" content="en">
    <meta name="author" content="David Misiko Kololi">
    <meta name="developer" content="David Misiko Kololi">
    <meta name="developer:email" content="kololimdavid@gmail.com">
    <meta name="designer" content="Themeforest Template">
    <meta name="designer:email" content="kololimdavid@gmail.com">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="fb:app_id" content="{{ config('services.facebook.client_id') }}">
    <meta name="robots" content="index,follow">
    <meta name="googlebot" content="index,follow">
    <meta property="og:site_name" content="{{config('app.name')}}">
    <!-- Meta Tags -->
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}
    <!-- rss feed -->
    @include('feed::links')
    <!-- Bootstrap5.0.2 CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="{{ asset('static/logo.png') }}" type="image/x-icon">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.3/css/all.min.css">
    <!-- Styles -->
    {{ Html::style('css/app.css') }} 
    {{ Html::style('css/custom.css') }}
    {{ Html::style('bootstrap5/css/bootstrap.min.css') }}
    {{ Html::style('fontawesome5/css/all.min.css') }}
    <!-- Custom Styles -->
    <style>
        html, body {height: 100%;}            
        body {margin: 0;padding: 0;width: 100%;display: table;font-weight: 100;font-size: 20px;font-family: 'Lato';margin-top: 50px;text-decoration: none;} 
    	.navbar { border-radius: 0; position: fixed; width: 100%; padding: 0 20px; z-index: 100; }
        .footer{padding: 20px;border-color: 5px solid red;width: 100%;background-color: grey}
        }
    </style>
</head>