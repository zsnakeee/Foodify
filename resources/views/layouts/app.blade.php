<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="eCommerce,shop,fashion">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}">
        <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/images/logo/favicon.png') }}">

        <title>{{ $title ?? config('app.name') }} {{ $title ? '| ' . config('app.name') : '' }}</title>

        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="preload-wrapper color-primary-8 color-main-text-2">
        <div class="preload preload-container">
            <div class="preload-logo">
                <div class="spinner"></div>
            </div>
        </div>

        <div id="wrapper">
            @include('partials.navbar')

            @if(isset($pageTitle))
                <div class="tf-page-title style-2">
                    <div class="container-full">
                        <div class="heading text-center">{{ $pageTitle }}</div>
                    </div>
                </div>
            @endif

            @if(isset($breadcrumbs))
                <div class="tf-breadcrumb">
                    <div class="container">
                        <div class="tf-breadcrumb-wrap d-flex justify-content-between flex-wrap align-items-center">
                            <div class="tf-breadcrumb-list">
                                @foreach($breadcrumbs as $name => $url)
                                    <a href="{{ $url }}" class="text">{{ $name }}</a>
                                    @if(!$loop->last)
                                        <i class="icon icon-arrow-right"></i>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{ $slot ?? '' }}

            @include('partials.footer')
        </div>


        <!-- Scroll Top Button -->
        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                      style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 286.138;"></path>
            </svg>
        </div>

        <livewire:frontend.pages.cart.mini/>
        <x-modals.quick-view/>
        <x-toaster-hub/>
    </body>
</html>
