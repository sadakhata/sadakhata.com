<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Make DB</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="{{asset('/assets/bootstrap/css/bootstrap.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('/assets/css/custom.css')}}">
		<link rel="shortcut icon" type="image/x-icon" href="{{('/assets/images/favicon.ico')}}" />
	</head>
	<body>
		<div class="jumbotron">
			<h1>সাদাখাতা<small>ডেটাবেজ মেকার</small></h1>
		</div>




		<div class="well">
			<form role="form" method="post" action="">
				<div class="form-group">
					<textarea class="form-control" name="banglaParagraph"></textarea>
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>

			<?php
				if(isset($_POST['banglaParagraph']))
				{
					?>
					<div class="alert alert-success">
						<span class="glyphicon glyphicon-ok"></span> <?php echo $cntAddedData; ?> Data Added Successfully!!
					</div>
					<div class="alert alert-info">
				
					<?php
					foreach ($insertedData as $value)
					{
						echo "<$value><br>";
					}
					echo "</div>";
				}
			?>

	</body>
</html>