@include('templates.javascript.sdk')
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<center><small>{{Lang::get('messages.likeOurFacebookPage')}}</small></center>
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
						<center><small>{{Lang::get('messages.shareOnGooglePlus')}}</small></center>
					</h3>
				</div>
				<div class="panel-body" style="min-height: 100px;">
					<center><div class="g-plusone" data-annotation="inline" data-width="300"></div></center>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<center><small>{{Lang::get('messages.likeThisPage')}}</small></center>
					</h3>
				</div>
				<div class="panel-body" style="min-height: 100px;">
					<center><div class="fb-like" data-href="{{Request::url()}}" data-width="100" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div></center>
				</div>
			</div>
		</div>
	</div>
</div>
