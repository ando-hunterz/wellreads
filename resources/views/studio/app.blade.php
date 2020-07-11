<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta property="og:image" content="">
    <meta property="og:title" content="">
    <meta property="og:description" content="">

    <meta name="twitter:image" content="">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:card" content="summary">

    <title>{{ config('app.name') }}</title>

    <link rel="canonical">
    <link href="{{ mix('studio.css') }}" rel="stylesheet">

    @if($scripts['darkMode'])
        <link rel="stylesheet" id="baseStylesheet" type="text/css" href="{{ mix('css/app-dark.css') }}">
        <link rel="stylesheet" id="highlightStylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.18.1/build/styles/sunburst.min.css">
    @else
        <link rel="stylesheet" id="baseStylesheet" type="text/css" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" id="highlightStylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.18.1/build/styles/github.min.css">
    @endif

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Karla|Merriweather:400,700">

    <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.18.1/build/highlight.min.js"></script>
    <script src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.18.1/build/styles/github.min.css">
</head>
<body>
<div id="studio">
    <router-view></router-view>
</div>
<footer class="mt-auto">
    <div class="col-11 mx-auto pb-5 footer">
        <div class="col-offset-1 col">
            <div class="row">
                <div class="col ml-4">
                    <div class="d-flex flex-column">
                        <div class="row my-4">
                          <img class="logo-white mx-3" src="/storage/icons/LogoPutih.png" alt />
                        </div>
                        <div class="row mt-2 mb-4">
                            <div class="btn-group justify-content-between d-flex flex-row footer-nav">
                                <a class="mx-3" href="">About</a>
                                <a class="mx-3" href="">Writers</a>
                                <a class="mx-3" href="">Terms</a>
                                <a class="mx-3" href="">Help</a>
                            </div>
                        </div>
                        <div class="row my-4">
                            <a href="" class="ml-3 mr-2"><img src="/storage/icons/IGLogo.png" alt=""></a>
                            <a href="" class="mx-2"><img src="/storage/icons/YoutubeLogo.png" alt=""></a>
                            <a href="" class="mx-2" style="width: 50px"><img src="/storage/icons/FacebookLogo.png" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-flex flex-column mt-5 pt-3">
                        <div class="row mt-5">
                            <p>Get Your Freshest Article</p>
                        </div>
                        <div class="row mt-2">
                            <div class="d-flex flex-row">
                                <input class="email-input" autocomplete="off" type="text" name="Email" id="email-signup" placeholder="Email..">
                                <button class="email-btn" id="signup-btn" data-toogle="dropdown">Signup</button>
                            </div>
                              </div>
                        </div>

                    </div>
                </>
            </div>


        </div>
    </div>
</footer>

<script>
    window.Studio = @json($scripts);
</script>

<script src="{{  asset('studio.js') }}" defer></script>
<script src="{{  asset('funct.js') }}"></script>
</body>
</html>
