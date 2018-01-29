<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9 ]>    <html lang="hr" class="no-js lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="hr" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>{{ getenv('WEB_NAME_short') }} :: {{ $page_title or 'Dobrodošli' }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{ getenv('WEB_META_KEYWORDS') }}">
    <meta name="description" content="{{ getenv('WEB_META_DESCRIPTION') }}">
    <meta name="author" content="{{ getenv('WEB_META_AUTHOR') }}">

    <!-- Facebook integration -->
    <meta property="og:title" content="{{ getenv('WEB_NAME') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ Request::url('/') }}" />
    <meta property="og:site_name" content="{{ getenv('WEB_NAME') }}" />
    <meta property="og:description" content="{{ getenv('WEB_META_DESCRIPTION') }}" />

    <!-- favicons and apple icon -->
    <!--[if IE]><link rel="shortcut icon" href="{{ asset('favicon.ico') }}"><![endif]-->
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('touch-icon-iphone.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('touch-icon-ipad.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('touch-icon-iphone-retina.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('touch-icon-ipad-retina.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('touch-icon-iphone-6-plus.png') }}">
    <link rel="canonical" href="{{ Request::url() }}" />