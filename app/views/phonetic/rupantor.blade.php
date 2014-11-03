<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="{{ asset('/assets/bootstrap/css/bootstrap.min.css' )}}">
		<link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/custom.css') }}">
		<link rel="shortcut icon" type="image/x-icon" href="{{ asset('/assets/images/favicon.ico') }}" />
		<title>{{ $versionTitle }}</title>
		<meta name="description" content="{{ $versionTitle }} | ভার্চুয়াল দুনিয়া রাঙিয়ে দিন বাংলা ভাষায়। আর বিশ্ব কে জানিয়ে দিন বাংলা ভাষা কতটা মায়াবী। মায়াবী এই বাংলা ভাষার ভাষাশহীদদের প্রতি অজস্র ভালোবাসা...Write Bangla from Any Device online. Using Sada khata you can write Bangla from Mobile without downloading any softwere">
		<meta property="og:title" content="{{ $versionTitle }}" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="{{ $versionUrl }}" />
		<meta property="og:description" content="{{ $versionTitle }} | ভার্চুয়াল দুনিয়া রাঙিয়ে দিন বাংলা ভাষায়। আর বিশ্ব কে জানিয়ে দিন বাংলা ভাষা কতটা মায়াবী। মায়াবী এই বাংলা ভাষার ভাষাশহীদদের প্রতি অজস্র ভালোবাসা...Write Bangla from Any Device online. Using Sada khata you can write Bangla from Mobile without downloading any softwere" />
        <meta property="og:image" content="{{asset('/assets/images/icon_128x128.png')}}" />
		





		<script type="text/javascript">
			function getElm(s){return document.getElementById(s);}
			function clearTextAreaInput()
			{
				getElm("textAreaInput").innerHTML = "";
			}
			function submitFBstatus()
			{
				getElm("fbStatusUpdateForm").submit();
			}
		</script>


	</head>
	<body>
	<!--Facebook API-->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/bn_IN/all.js#xfbml=1&appId=483263038412364";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
	<!--end FB API-->

		@include('templates.header')
		<div class="page-header" style="padding-left:15px;">
			<h3>
				<?php
					echo $versionTitle;
				?>
			</h3>
		</div>
		<ul class="pager">
			<li class="next"><a href="{{url('keymap/'. $versionName)}}">কিম্যাপ</a></li>
		</ul>
		<div class="well">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						এখানে ইংরেজী ফন্টে বাংলা লিখুনঃ
					</h3>
				</div>
				<div class="panel-body">
					<form role="form" method="post" action="#output">
						<div class="form-group">
							<textarea class="form-control" id="textAreaInput" name="input"><?php echo $input; ?></textarea>
						</div>
						<center>
							<button type="submit" class="btn btn-default">মায়াবী বাংলায় রূপান্তর</button>
							<button type="button" class="btn btn-danger" onclick="clearTextAreaInput()">Clear Input Box</button>
						</center>
					</form>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-body">
					<form role="form" action="{{url('confirm')}}" method="post" id="fbStatusUpdateForm">
						<div class="form-group" id="output">
							<textarea class="form-control" name="status" id="textAreaOutput"><?php echo $output; ?></textarea>
						</div>
					</form>
				</div>
				<div class="panel-footer">
						<div class="alert alert-info" id="divOutput">
							<?php echo nl2br($output); ?>
						</div>
						<?php
							
							if($versionName == "shuvro")
							{
								echo '<div>';
								echo $suggestion;
								echo $suggestionJS;
								echo '</div><br>';
							}
							
						?>
					<center>
						<?php
							if($versionName == "shuvro")
							{
								
								echo '<button type="button" onClick="change()" class="btn btn-default">Correction</button>';		
							}
						?>
						<button class="btn btn-default" onclick="submitFBstatus();">ফেসবুকে স্ট্যাটাস হিসেবে দিন</button>
					</center>
				</div>

			</div>
			<div class="alert alert-success">Time Required {{$elapsed_time}} seconds.</div>
			@include('templates.footer')
		</div>
	</body>
</html>
<script type="text/javascript">
function fixEmoticon()
{
	var divOutput = getElm('divOutput');
	var textAreaOutput = getElm('textAreaOutput');
	var emoIn = [	'ঃ\\\)', 	'ঃ\\\(', 	'ঃ\'\\\(', 	'ঃ\'\\\)', 	'ঃ/', 	'ঃ\\\\', 	'ঃভ', 	'ঃও',	'ঃপি',	'ঃডি', 	'ঃপ', 	'ঃড', 	';প', 	'ঃঅ', 	';ড', 	';অ', 	';ও'];
	var emoOut = [	':)', 		':(', 		':\'(', 	':\')', 	':/', 	':\\', 		':v', 	':o', 	':p',	':D',		':p', 	':D', 	';p', 	':o', 	';D', 	';o', 	';o'];
	for(var i in emoIn)
	{
		var rgx = new RegExp(emoIn[i], "gi");
		divOutput.innerHTML = divOutput.innerHTML.replace(rgx, emoOut[i]);
		textAreaOutput.innerHTML = textAreaOutput.innerHTML.replace(rgx, emoOut[i]);
		textAreaOutput.value = textAreaOutput.value.replace(rgx, emoOut[i]);
	}
}
fixEmoticon();
</script>