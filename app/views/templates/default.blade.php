<!DOCTYPE html>
<html lang="en">
	<head>
		@yield('head')
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('/assets/images/favicon.ico') }}" />

		<meta property="og:type" content="website" />
		<meta property="og:url" content="{{ Request::url(); }}" />
		<meta name="wot-verification" content="087463f0456c6aeec72f"/> <!-- mywot.com verification -->
		<meta property="og:image" content="{{asset('/assets/images/icon_128x128.png')}}" />
		<meta name="keywords" content="bangla website, bangla writing tool, bangla writing software, sadakhata, sada khata, sadakhata.binhoster.com, write bangla from mobile, bangla writing, online bangla writing tool">

		<link rel="stylesheet" type="text/css" href="{{ asset('/assets/bootstrap/css/bootstrap.min.css' )}}">
		<link rel="stylesheet" type="text/css" href="{{ asset('/assets/font-awesome/css/font-awesome.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/bootstrap-social.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/custom.css') }}">
		
		<!--
			// New Logo Introduced.
			// Configuration for Apple, Android, Windows 8/10
		-->

		<link rel="apple-touch-icon" sizes="180x180" href="/assets/images/apple-touch-icon.png">
		<link rel="icon" type="image/png" href="/assets/images/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="/assets/images/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="/assets/images/manifest.json">
		<link rel="mask-icon" href="/assets/images/safari-pinned-tab.svg" color="#e14938">
		<meta name="msapplication-config" content="/assets/images/browserconfig.xml">
		<meta name="theme-color" content="#e14938">

		<!-- New Logo Configuration end. -->

		@include('templates.javascript.analyticstracking')
	</head>
	<body>
		@include('templates.header')
		@yield('content')
	</body>
</html>