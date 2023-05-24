
@php
    $addedCSS = [];
    $adminPanelPath = trans('siteConfig.path.adminPanel');
@endphp

@foreach($componentsJsCss as $componentsCss)

    @php

        $css = collect(trans('component.'.$componentsCss.'.css'))->reject(function ($name) {
            return empty($name);
        });

        $includeCss = collect(trans('component.'.$componentsCss.'.include.css'))->reject(function ($name) {
            return empty($name);
        });

    @endphp

    @foreach($css as $cssFilePath)
        @if(!in_array($cssFilePath,$addedCSS))
            @php($addedCSS[] = $cssFilePath)
            <link rel="stylesheet" type="text/css" href="{{$cssFilePath}}">
        @endif
    @endforeach

    {{-- <link rel="stylesheet" type="text/css" href="{{$adminPanelPath.'/css/ideaecom.css'}}"> --}}

    @foreach($includeCss as $cssFilePath)
        @include($cssFilePath)
    @endforeach

@endforeach
