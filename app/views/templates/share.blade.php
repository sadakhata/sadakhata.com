@include('templates.javascript.sdk')
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<center><small>আমাদের ফেসবুক পেইজ লাইক বা শেয়ার করুন</small></center>
					</h3>
				</div>
				<div class="panel-body" style="min-height: 100px;">
					<center><div class="fb-like" data-href="https://facebook.com/sadakhata" data-width="100" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div></center>
				</div>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<center><small>গুগল প্লাসে শেয়ার করুন</small></center>
					</h3>
				</div>
				<div class="panel-body" style="min-height: 100px;">
					<center><g:plusone annotation="inline"></g:plusone><center>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<center><small>এই পেইজটি লাইক বা শেয়ার করুন</small></center>
					</h3>
				</div>
				<div class="panel-body" style="min-height: 100px;">
					<center><div class="fb-like" data-href="{{Request::url()}}" data-width="100" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div></center>
				</div>
			</div>
		</div>
	</div>
</div>