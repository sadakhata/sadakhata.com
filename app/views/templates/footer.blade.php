@include('templates.share')
<hr />
<div class="row">
	<div class="col-md-4">
		<li>
			<a href="http://facebook.com/sadakhata"><b>ফেসবুক ফ্যান পেইজ</b></a>
		</li>
	</div>

	<div class="col-md-4">
		<li>
	    	<a href="{{url('basic')}}">
	        	<b>
	            	সাদাখাতা বেসিক
	            </b>
	        </a>
	    </li>
	    <li>
	    	<a href="{{url('dhusor')}}">
	        	<b>
	            	ধূসর সাদাখাতা
	            </b>
	        </a>
	    </li>
	    <li>
	    	<a href="{{url('shobdopata')}}">
	        	<b>
	            	শব্দপাতা
	            </b>
	        </a>
	    </li>
		<li>
			<a href="{{url('shuvro') }}">
				<b>
					শুভ্র সাদাখাতা
				</b>
			</a>
		</li>
	</div>
	
	<div class="col-md-4">
		<li>
	    	<b>
	        	<a href="{{url('/')}}">
	            	হোম পেইজ
	            </a>
	       </b>
	    </li>
	</div>
</div>