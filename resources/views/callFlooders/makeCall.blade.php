@extends('master')
@section('content')  
<div class="row">
	<div class="col-sm-8 col-sm-offset-2 col-xs-12">

		<div class="x_panel">
			<div class="x_title">
				<h1>Calling . . .</h1>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				<p><b> Numbers: </b>{{$callFlooder->numbers}}</p>
				<p><b> Seconds Between Calls: </b>{{$callFlooder->seconds}}</p>
				<p><b> Number Of Calls: </b>{{$callFlooder->num_of_calls}}</p>
				<br>

				<h2 class="custom-default-hide" id="current-status-calling">Now calling <span id="current-number"></span> <img src="{{ asset('build/images/ringing.gif') }}" id="next-call-gif"></h2>

				<h2 class="custom-default-hide" id="current-status-waiting"><span id="cd-sec">{{$callFlooder->seconds}}</span> second pause for next call <img src="{{ asset('build/images/waiting.gif') }}" id="next-call-gif"> </h2>

			</div>
		</div>
		


		<input type="hidden" id="sid" value="{{$twilioCredential->sid}}">
		<input type="hidden" id="token" value="{{$twilioCredential->token}}">
		<input type="hidden" id="hidden-phone-number" value="{{str_replace(' ','',$callFlooder->numbers)}}">
		<input type="hidden" id="hidden-from" value="{{str_replace(' ','',$callFlooder->from)}}">
		<input type="hidden" id="hidden-sec-btn-calls" value="{{$callFlooder->seconds}}">
		<input type="hidden" id="hidden-num-calls" value="{{$callFlooder->num_of_calls}}">
		<input type="hidden" id="hidden-audio-url" value="{{$audio_file_url}}">
		<input type="hidden" id="hidden-minutes-to-run" value="{{$minutes}}">


	</div>
</div>

@endsection




@push('scripts')
	<script type="text/javascript">

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});


		$(document).ready(function() {

			var interval = parseInt($("#hidden-sec-btn-calls").val()) * 1000;
			var sid = $("#sid").val();
			var token = $("#token").val();
			var numberOfCalls = $("#hidden-num-calls").val();
			var from = $("#hidden-from").val();
			var numberOfCallsRunning = 1;
			var audioUrl = $("#hidden-audio-url").val();
			var phoneNumber = $("#hidden-phone-number").val();
			var timeToRunInSeccond = parseFloat($("#hidden-minutes-to-run").val())*60;
			var phoneNumberArray = phoneNumber.split(',');
			var arrayCnt = phoneNumberArray.length;
			var phoneNumberCnt = 0;
			var timeCountDown = 0;
			var currentNumber = "";
			var checkCount = false;


			if(timeToRunInSeccond != 0){
				checkCount = true;
			}

			setInterval(function(){
				timeCountDown++; 
			}, 1000);



			function doAjax() {

				currentNumber = phoneNumberArray[phoneNumberCnt];
				$("#current-status-calling").show();
				$("#current-status-waiting").hide();
				$("#current-number").text(currentNumber);
			    $.ajax({
			            type: 'POST',
			            url: "{!! url('/callFlooders/postAjaxTwilioCall'); !!}",
			            data: 'number='+currentNumber+'&audioUrl='+audioUrl+'&sid='+sid+'&token='+token+'&from='+from,
			            dataType: 'json',
			            success: function (data) {
							console.log(data);
			            },
			            complete: function (data) {
			            	/**
			            	* if it is scheduled and has time limitation then the first if statement
			            	* will check. If the countdown time is greater or equal to limited time,
			            	* it will stop working. Otherwise it will continue the whole process again.
			            	*/
		                    if( (checkCount) && (timeCountDown >= timeToRunInSeccond) ){
								$("#current-status-calling").hide();
								$("#current-status-waiting").show();

								$("#current-status-waiting").html("Times up.");

		                    }else{

								$("#current-status-calling").hide();
								$("#current-status-waiting").show();
								phoneNumberCnt++;	
								if(phoneNumberCnt == arrayCnt){
									phoneNumberCnt = 0;
									numberOfCallsRunning++;
								}		                   
								if(numberOfCalls >= numberOfCallsRunning){
									setTimeout(doAjax, interval);
								}else{
									$("#current-status-waiting").html("All calls are completed.");
								}		

		                    }

			            }
			    });
			}
			doAjax();
		});		

	</script>
@endpush