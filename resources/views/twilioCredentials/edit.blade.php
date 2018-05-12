@extends('master')
@section('content')  
<div class="row">
	<div class="col-sm-8 col-sm-offset-2 col-xs-12">

		<div class="x_panel">
			<div class="x_title">
				<h2>Update Twilio Credentials</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				{!! Form::model($twilioCredential, ['method' => 'PATCH','route' => ['twilioCredentials.update', $twilioCredential->id], "files" => true]) !!}

					    {{ Form::label('sid', 'ACCOUNT SID:') }}
					    {{ Form::text('sid', null, array("class" => "form-control", "required" => "required" )) }}

					    {{ Form::label('token', 'AUTH TOKEN:') }}
					    {{ Form::text('token', null, array("class" => "form-control", "required" => "required" )) }}

					    {{ Form::submit('Update', array('class' => 'btn btn-lg btn-block btn-success form-margin')) }}

				{!! Form::close() !!}

			</div>
		</div>


	</div>
</div>

@endsection