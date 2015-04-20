@extends('templates.default')

@section('head')
	<title>{{ $versionTitle }}</title>
	<meta name="description" content="{{ $versionTitle }} | {{Lang::get('messages.virtualDuniyaRangiyeDin')}}...Write Bangla from Any Device online. Using Sada khata you can write Bangla from Mobile without downloading any softwere">
	<meta property="og:title" content="{{ $versionTitle }}" />
	<meta property="og:description" content="{{ $versionTitle }} | {{Lang::get('messages.virtualDuniyaRangiyeDin')}}...Write Bangla from Any Device online. Using Sada khata you can write Bangla from Mobile without downloading any softwere" />
	<script type="text/javascript" src="{{asset('/assets/js/fixEmoticon.js')}}"></script>
@stop

@section('content')

	<div class="page-header" style="padding-left:15px;">
		<h3>
			{{ $versionTitle }}
		</h3>
	</div>
	<ul class="pager">
		<li class="next">
			<a target="_blank" href="{{url('keymap/'. $versionName)}}">
				<i class="fa fa-book fa-fw"></i>&nbsp; {{Lang::get('extras.keymap')}}
			</a>
		</li>
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
						<button type="submit" class="btn btn-default">
							<i class="fa fa-pencil fa-fw"></i>&nbsp; {{Lang::get('messages.convert')}}
						</button>
						<button type="button" class="btn btn-danger" onclick="getElementById('textAreaInput').innerHTML='';">
							<i class="fa fa-trash-o fa-lg"></i>&nbsp; {{Lang::get('messages.clearInputBox')}}
						</button>
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
						<button class="btn btn-social btn-facebook" type="submit">
							<i class="fa fa-facebook"></i>{{Lang::get('messages.updateFbStatus')}}
						</button>
						<button type="button" onClick="tweet()" class="btn btn-social btn-twitter">
							<i class="fa fa-twitter"></i>{{Lang::get('messages.tweet')}}
						</button>
					</center>
				</div>
			</form>
		</div>
		<div class="alert alert-success">Time Required {{$elapsed_time}} seconds.</div>
		@include('templates.footer')
	</div>

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
@stop
