<!DOCTYPE html>
<html lang="en">
	<head>
		@if(isset($loginUrl))
			<script type="text/javascript">window.location="{{ $loginUrl }} ";</script>
		@endif
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('/assets/images/favicon.ico') }}" />
		<title>{{ $title }}</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('/assets/bootstrap/css/bootstrap.min.css') }}">
	</head>
	<body>
		<div class="alert alert-info">
			<h3>{{ $title }}</h3>
		</div>
			<div class="container">
				@if(isset($reasons))
					<strong>Possible Reasons:</strong>
					<br>
					<div class="container">
						@foreach($reasons as $reason)
							<p class="alert alert-danger">{{ $reason }}</p>
						@endforeach
						<center><a href="{{url('/')}}">← হোম পেইজ</a></center>
					</div>
				@elseif( isset($loginUrl) )
					If you are not redirected, <a href="{{ $loginUrl }}">click here...</a>
				@else
					<div class="alert alert-success">
						আপনার স্ট্যাটাস সফল ভাবে আপডেট করা হয়েছে!!!<br>
						আপনার <a href="https://www.facebook.com/me">প্রোফাইলে</a> দেখুন।<br>
						<a href="{{url('/')}}">← হোম পেইজ</a>
					</div>
				@endif
			</div>
	</body>
</html>