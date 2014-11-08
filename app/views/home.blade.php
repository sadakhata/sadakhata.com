<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('/assets/images/favicon.ico') }}" />
		<title>সাদাখাতা | ফোনেটিক বাংলা কনভার্টার</title>
		<meta property="og:title" content="সাদা খাতা | ফোনেটিক বাংলা কনভার্টার" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="{{ $_SERVER['SITE_ADDR']; }}" />
		<meta name="wot-verification" content="087463f0456c6aeec72f"/> <!-- mywot.com verification -->
		<meta name="description" content="ভার্চুয়াল দুনিয়া রাঙিয়ে দিন বাংলা ভাষায়। আর বিশ্ব কে জানিয়ে দিন বাংলা ভাষা কতটা মায়াবী। মায়াবী এই বাংলা ভাষার ভাষাশহীদদের প্রতি অজস্র ভালোবাসা...Write Bangla from Any Device online. Using Sada khata you can write Bangla from Mobile without downloading any softwere">
		<meta property="og:description" content="ভার্চুয়াল দুনিয়া রাঙিয়ে দিন বাংলা ভাষায়। আর বিশ্ব কে জানিয়ে দিন বাংলা ভাষা কতটা মায়াবী। মায়াবী এই বাংলা ভাষার ভাষাশহীদদের প্রতি অজস্র ভালোবাসা...Write Bangla from Any Device online. Using Sada khata you can write Bangla from Mobile without downloading any softwere" />
		<meta property="og:image" content="{{asset('/assets/images/icon_128x128.png')}}" />
		<meta name="keywords" content="bangla website, bangla writing tool, bangla writing software, sadakhata, sada khata, sadakhata.binhoster.com, write bangla from mobile, bangla writing, online bangla writing tool">
		<link rel="stylesheet" type="text/css" href="{{ asset('/assets/bootstrap/css/bootstrap.min.css') }}">
	</head>

	<body>
		<div class="jumbotron">
			<div class="page-header">
				<h1>
					সাদাখাতা <small>ফোনেটিক বাংলা কনভার্টার</small>
				</h1>
			</div>
			<p style="color:rgb(20,20,20);">
				ভার্চুয়াল দুনিয়া রাঙিয়ে দিন বাংলা ভাষায়। আর বিশ্ব কে জানিয়ে দিন বাংলা ভাষা কতটা মায়াবী। মায়াবী এই বাংলা ভাষার ভাষা শহীদদের প্রতি অজস্র ভালোবাসা.....
			</p>
		</div>
		<div class="container">
			<p class="lead">
				সাদাখাতা ফোনেটিক বাংলা কনভার্টার একটি সফটওয়্যার যেটি আপনি ব্যাবহার করতে পারবেন যেকোন মোবাইল/আইপ্যাড/কম্পিউটার/ম্যাকবুক থেকে। এটি একটি অনলাইন ভিত্তিক কনভার্টার তাই এটি ব্যাবহার করতে নেট কানেকশন প্রয়োজন হবে। আপনার প্রিয় ভার্সন বেছে নিন তালিকা থেকে। তারপর কিম্যাপ অনুসারে রূপান্তর করে কপি করে যেখানে প্রয়োজন সেখানে পেস্ট করুন! ফেসবুক এ স্ট্যাটাস দিতে পারবেন সরাসরি সাদাখাতা থেকে কোনো কপি পেস্ট ছাড়াই(<a href="{{url('help/fbstatus')}}">কিভাবে?</a>)

			</p>
			<div class="row">
				<div class="col-md-4">
					<b>
						ভার্সন গুলো
					</b>
					<br>
					<li>
						<a href="{{url('basic')}}">
							সাদাখাতা বেসিক
						</a>
					</li>
					<li>
						<a href="{{url('dhusor')}}">
							ধূসর সাদাখাতা
						</a>
					</li>
					<li>
						<a href="{{url('shobdopata')}}">
							 শব্দপাতা (অভ্র কিম্যাপ)
						</a>
					</li>
					<li>
						<a href="{{url('shuvro')}}">
							শুভ্র সাদাখাতা
						</a>
					</li>
				</div>
				<div class="col-md-4">
					<b>
						যোগাযোগ
					</b>
					<br>
					<li>
						<a href="http://facebook.com/hasib.mo">
							ডেভলপার
						</a>
					</li>
					<li>
						<a href="http://facebook.com/sadakhata">
							ফেসবুক ফ্যান পেইজ
						</a>
					</li>
				
				</div>
				<div class="col-md-4">
					<b>
						সাহায্য
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