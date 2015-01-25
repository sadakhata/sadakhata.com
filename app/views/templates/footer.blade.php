@include('templates.share')
<hr />
<div class="row">
	<div class="col-md-4">
		<li>
			<a href="http://facebook.com/sadakhata"><b>{{Lang::get('extras.facebookPage')}}</b></a>
		</li>
	</div>

	<div class="col-md-4">
		<li>
			<a href="{{url('basic')}}">
				<b>
					{{Lang::get('names.basic')}}
				</b>
			</a>
		</li>
		<li>
			<a href="{{url('dhusor')}}">
				<b>
					{{Lang::get('names.dhusor')}}
				</b>
			</a>
		</li>
		<li>
			<a href="{{url('shobdopata')}}">
				<b>
					{{Lang::get('names.shobdopata')}}
				</b>
			</a>
		</li>
		<li>
			<a href="{{url('shuvro') }}">
				<b>
					{{Lang::get('names.shuvro')}}
				</b>
			</a>
		</li>
	</div>

	<div class="col-md-4">
		<li>
			<b>
				<a href="{{url('/')}}">
					{{Lang::get('extras.homePage')}}
				</a>
			</b>
		</li>
	</div>
</div>