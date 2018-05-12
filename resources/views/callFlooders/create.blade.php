@extends('master')
@section('content')  
<div class="row">
	<div class="col-sm-8 col-sm-offset-2 col-xs-12">

		<div class="x_panel">
			<div class="x_title">
				<h2>Add Call Flooder</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				{!! Form::open(["route"=>"callFlooders.store", "id" => "demo-form2", "class" => "form-horizontal form-label-left form-group", "data-parsley-validate row" => ""]) !!}

					    {{ Form::label('name', 'Name:') }}
					    {{ Form::text('name', null, array("class" => "form-control", "required" => "required", "maxlength" => "191" )) }}

					    {{ Form::label('seconds', 'Seconds Between Phone Calls:', array('class' => ' form-margin')) }}
					    {{ Form::text('seconds', null, array("class" => "form-control", "required" => "required", "maxlength" => "10" )) }}

					    {{ Form::label('numbers', 'Phone Number That Will Be Called:', array('class' => ' form-margin')) }}
					    {{ Form::textarea('numbers', null, array("class" => "form-control", "required" => "required", 'placeholder' =>'Ex. +440129291, +4492392303,+0192309239' )) }}

					    {{ Form::label('num_of_calls', 'Number of Phone Calls', array('class' => ' form-margin')) }}
					    {{ Form::text('num_of_calls', null, array("class" => "form-control", "required" => "required", "maxlength" => "5" )) }}

					    {{ Form::label('audio_id', 'Select Audio:', array('class' => ' form-margin')) }}
					    {{ Form::select('audio_id', $audios,
						   null,
						   array("class" => "form-control", "required" => "required" ) 
						) }}

						{{ Form::label('from', 'From:', array('class' => ' form-margin')) }}
					    {{ Form::text('from', null, array("class" => "form-control", "required" => "required", "maxlength" => "20", 'placeholder' =>'Your Twilio Phone Number' )) }}						

					    {{ Form::submit('Create', array('class' => 'btn btn-lg btn-block btn-success form-margin')) }}

				{!! Form::close() !!}

			</div>
		</div>


	</div>
</div>

@endsection