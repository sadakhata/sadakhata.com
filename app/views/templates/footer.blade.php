@include('templates.share')
<hr />
<div class="row">
	<div class="col-md-4">
		<li>
			<a href="http://facebook.com/sadakhata"><b>{{Lang::get('messages.facebookPage')}}</b></a>
		</li>
	</div>

	<div class="col-md-4">
		<li>
			<a href="{{url('basic')}}">
				<b>
					{{Lang::get('messages.basic')}}
				</b>
			</a>
		</li>
		<li>
			<a href="{{url('dhusor')}}">
				<b>
					{{Lang::get('messages.dhusor')}}
				</b>
			</a>
		</li>
		<li>
			<a href="{{url('shobdopata')}}">
				<b>
					{{Lang::get('messages.shobdopata')}}
				</b>
			</a>
		</li>
		<li>
			<a href="{{url('shuvro') }}">
				<b>a
					{{Lang::get('messages.shuvro')}}
				</b>
			</a>
		</li>
	</div>

	<div class="col-md-4">
		<li>
			<b>
				<a href="{{url('/')}}">
					{{Lang::get('messages.homePage')}}
				</a>
			</b>
		</li>
	</div>
</div>