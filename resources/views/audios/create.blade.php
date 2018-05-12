@extends('master')
@section('content')  
<div class="row">
	<div class="col-sm-8 col-sm-offset-2 col-xs-12">

		<div class="x_panel">
			<div class="x_title">
				<h2>Upload Audio</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />

				{!! Form::open(["route"=>"audios.store", "files" => true]) !!}

					    {{ Form::label('name', 'Name:') }}
					    {{ Form::text('name', '', array("class" => "form-control", "required" => "required", "maxlength" => "191")) }}

					    {{ Form::label('file', 'Upload a mp3 file:', array("class" => "form-margin") ) }}
					    {{ Form::file('file', array("class" => "form-control", "required" => "required" )) }}

					    {{ Form::submit('Upload', array('class' => 'btn btn-lg btn-block btn-success form-margin')) }}

				{!! Form::close() !!}

			</div>
		</div>


	</div>
</div>

@endsection