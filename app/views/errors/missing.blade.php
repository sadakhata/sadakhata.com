<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('/assets/images/favicon.ico') }}" />
	<link rel="stylesheet" type="text/css" href="{{asset('/assets/bootstrap/css/bootstrap.min.css')}}">
	<title>Page Not Found</title>

	<style type="text/css">
	body{
		margin:15% 20%;
	}
	</style>

</head>

<body>
<img src="{{asset('/assets/images/cry.gif')}}" alt="404 Page Not Found" height="100" width="100"  />
<p>
	আপনার দেয়া ঠিকানা  {{$_SERVER['REQUEST_URI']}} খুঁজতে খুঁজতে হয়রান হয়ে গেলাম, তবুও আপনার দেয়া ঠিকানা খুঁজে পেলাম না। হয়ত ঠিকানা ভুল টাইপ করেছেন, অথবা লিঙ্ক সরিয়ে নেয়া হয়েছে। দুঃখিত :(
</p>
<p>
	I am tired of finding the URL you gave me. May be you misspelled the URL or the URL is taken away. We are extremely sorry!!!
</p>
<hr />
<p>
	Go Back to {{link_to('/', '←Home Page')}}
</p>

</body>
</html>