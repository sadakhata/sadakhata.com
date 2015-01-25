<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('/assets/images/favicon.ico') }}" />
		<title>{{ Lang::get('names.sadakhata') }} | {{Lang::get('names.phoneticBanglaConverter')}}</title>
		<meta property="og:title" content="{{ Lang::get('names.sadakhata') }} | {{Lang::get('names.phoneticBanglaConverter')}}" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="{{ $_SERVER['SITE_ADDR']; }}" />
		<meta name="wot-verification" content="087463f0456c6aeec72f"/> <!-- mywot.com verification -->
		<meta name="description" content="{{Lang::get('messages.virtualDuniyaRangiyeDin')}}...Write Bangla from Any Device online. Using Sada khata you can write Bangla from Mobile without downloading any softwere">
		<meta property="og:description" content="{{Lang::get('messages.virtualDuniyaRangiyeDin')}}...Write Bangla from Any Device online. Using Sada khata you can write Bangla from Mobile without downloading any softwere" />
		<meta property="og:image" content="{{asset('/assets/images/icon_128x128.png')}}" />
		<meta name="keywords" content="bangla website, bangla writing tool, bangla writing software, sadakhata, sada khata, sadakhata.binhoster.com, write bangla from mobile, bangla writing, online bangla writing tool">
		<link rel="stylesheet" type="text/css" href="{{ asset('/assets/bootstrap/css/bootstrap.min.css') }}">
	</head>

	<body>
		<div class="jumbotron">
			<div class="page-header">
				<h1>
					{{Lang::get('names.sadakhata')}} <small>{{Lang::get('names.phoneticBanglaConverter')}}</small>
				</h1>
			</div>
			<p style="color:rgb(20,20,20);">
				{{Lang::get('messages.virtualDuniyaRangiyeDin')}}
			</p>
		</div>
		<div class="container">
			<p class="lead">
				{{Lang::get('messages.description')}}(<a href="{{url('help/fbstatus')}}">{{Lang::get('extras.how')}}</a>)

			</p>
			<div class="row">
				<div class="col-md-4">
					<b>
						{{Lang::get('extras.versions')}}
					</b>
					<br>
					<li>
						<a href="{{url('basic')}}">
							{{Lang::get('names.basic')}}
						</a>
					</li>
					<li>
						<a href="{{url('dhusor')}}">
							{{Lang::get('names.dhusor')}}
						</a>
					</li>
					<li>
						<a href="{{url('shobdopata')}}">
							 {{Lang::get('names.shobdopata')}}
						</a>
					</li>
					<li>
						<a href="{{url('shuvro')}}">
							{{Lang::get('names.shuvro')}}
						</a>
					</li>
				</div>
				<div class="col-md-4">
					<b>
						{{Lang::get('extras.contact')}}
					</b>
					<br>
					<li>
						<a href="http://facebook.com/hasib.mo">
							{{Lang::get('extras.developer')}}
						</a>
					</li>
					<li>
						<a href="http://facebook.com/sadakhata">
							{{Lang::get('extras.facebookPage')}}
						</a>
					</li>
				
				</div>
				<div class="col-md-4">
					<b>
						{{Lang::get('extras.help')}}
					</b>
					<br>
					<li>
						<a href="{{url('help/font')}}">
							Bangla Font Problem?
						</a>
					 </li>
					 <li>
						<a href="{{url('help/fbstatus')}}">
							How to Update Facebook Status from Sadakhata?
						</a>
					</li>
				</div>
			</div>
			<br />
			<hr>
			@include('templates.share')
		</div>
	</body>
</html>