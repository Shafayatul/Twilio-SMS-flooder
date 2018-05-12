@extends('master')
@section('content')  
<div class="row">
	<div class="col-sm-8 col-sm-offset-2 col-xs-12">

		<div class="x_panel">
			<div class="x_title">
				<h2>Edit Schedule</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />

				{!! Form::model($schedule, ['method' => 'PATCH','route' => ['schedules.update', $schedule->id], "files" => true]) !!}

					    {{ Form::label('name', 'Name:') }}
					    {{ Form::text('name', null, array("class" => "form-control", "required" => "required", "maxlength" => "191" )) }}

					    {{ Form::label('call_flooder_id', 'Select Call Flooder:', array('class' => ' form-margin')) }}
					    {{ Form::select('call_flooder_id', $callFlooders,
						   null,
						   array("class" => "form-control", "required" => "required" ) 
						) }}

						{{ Form::label('minutes', 'Number Of minutes to run:', array('class' => ' form-margin')) }}
					    {{ Form::text('minutes', null, array("class" => "form-control", "required" => "required", "maxlength" => "10" )) }}


						{{ Form::label('date', 'Date:', array('class' => ' form-margin')) }}
					    {{ Form::date('date', null, array("class" => "controls form-control", "required" => "required")) }}


					    {{ Form::submit('Add schedule', array('class' => 'btn btn-lg btn-block btn-success form-margin')) }}

				{!! Form::close() !!}

			</div>
		</div>


	</div>
</div>

@endsection