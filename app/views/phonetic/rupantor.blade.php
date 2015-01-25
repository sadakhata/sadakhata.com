<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="{{ asset('/assets/bootstrap/css/bootstrap.min.css' )}}">
		<link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/custom.css') }}">
		<link rel="shortcut icon" type="image/x-icon" href="{{ asset('/assets/images/favicon.ico') }}" />
		<title>{{ $versionTitle }}</title>
		<meta name="description" content="{{ $versionTitle }} | {{Lang::get('messages.virtualDuniyaRangiyeDin')}}...Write Bangla from Any Device online. Using Sada khata you can write Bangla from Mobile without downloading any softwere">
		<meta property="og:title" content="{{ $versionTitle }}" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="{{ $versionUrl }}" />
		<meta property="og:description" content="{{ $versionTitle }} | {{Lang::get('messages.virtualDuniyaRangiyeDin')}}...Write Bangla from Any Device online. Using Sada khata you can write Bangla from Mobile without downloading any softwere" />
		<meta property="og:image" content="{{asset('/assets/images/icon_128x128.png')}}" />
		<script type="text/javascript" src="{{asset('/assets/js/fixEmoticon.js')}}"></script>
	</head>
	<body>
		@include('templates.header')
		<div class="page-header" style="padding-left:15px;">
			<h3>
				{{ $versionTitle }}
			</h3>
		</div>
		<ul class="pager">
			<li class="next"><a target="_blank" href="{{url('keymap/'. $versionName)}}">{{Lang::get('extras.keymap')}}</a></li>
		</ul>
		<div class="well">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						{{Lang::get('messages.writeBanglaHere')}}
					</h3>
				</div>
				<div class="panel-body">
					<form role="form" method="post" action="#output">
						<div class="form-group">
							<textarea class="form-control" id="textAreaInput" name="input">{{ $input }}</textarea>
						</div>
						<center>
							<button type="submit" class="btn btn-default">{{Lang::get('messages.convert')}}</button>
							<button type="button" class="btn btn-danger" onclick="getElementById('textAreaInput').innerHTML='';">{{Lang::get('messages.clearInputBox')}}</button>
						</center>
					</form>
				</div>
			</div>
			<div class="panel panel-default">
				<form role="form" action="{{url('confirm')}}" method="post">
					<div class="panel-body">
						<div class="form-group" id="output">
							<textarea class="form-control" name="status" id="textAreaOutput">{{ $output }}</textarea>
						</div>
					</div>
					<div class="panel-footer">
						<div class="alert alert-info" id="divOutput">
							{{ nl2br($output) }}
						</div>
						@if($versionName == "shuvro")
							{{ '<div>' }}
							{{ $suggestion }}
							{{ $suggestionJS }}
							{{ '</div><br>' }}
						@endif
						<center>
							@if($versionName == "shuvro")
								{{ '<button type="button" onClick="change()" class="btn btn-default">Correction</button>' }}		
							@endif
							<button class="btn btn-default" type="submit">{{Lang::get('messages.updateFbStatus')}}</button>
							<button type="button"  onClick="tweet()" class="btn btn-primary">{{Lang::get('messages.tweet')}}</button>
						</center>
					</div>
				</form>
			</div>
			<div class="alert alert-success">Time Required {{$elapsed_time}} seconds.</div>
			@include('templates.footer')
		</div>
	</body>
</html>
<script type="text/javascript">fixEmoticon();</script>
<script type="text/javascript">
function tweet()
{
	var twitterStatusCharacterLimit = 140;
	var text = document.getElementById('textAreaOutput').value;
	text = text.substr(0, twitterStatusCharacterLimit);
	var link = "https://twitter.com/intent/tweet?text="+text;
	window.location.assign( link );
}
</script>
