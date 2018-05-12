@extends('master')
@section('content')  
<div class="row">
	<div class="col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
		    <h2>All Call Flooder</h2>
		    <div class="clearfix"></div>
		  </div>

		  <div class="x_content">

		   <div class="table-responsive">
		      <table class="table table-striped jambo_table bulk_action text-center">
		        <thead>
		          <tr>
		            <th class="column-title text-center">ID </th>
		            <th class="column-title text-center">Name </th>
		            <th class="column-title text-center">From </th>
		            <th class="column-title text-center">Sec Beteen Calls </th>
		            <th class="column-title text-center">No. of Calls </th>
		            <th class="column-title text-center">Audio </th>
		            <th class="column-title text-center">Date </th>
		            <th class="column-title no-link last text-center"> Actions </th>
		          </tr>
		        </thead>

		        <tbody>
		        	@foreach($callFlooders as $callFlooder)
			          <tr id="row_{{$callFlooder->id}}">
			            <td class="">{{$callFlooder->id}}</td>
			            <td class="">{{$callFlooder->name}}</td>
			            <td class="">{{$callFlooder->from}}</td>
			            <td class="">{{$callFlooder->seconds}}</td>
			            <td class="">{{$callFlooder->num_of_calls}}</td>
			            <td class="">{{$audios[$callFlooder->audio_id]}}</td>
			            <td class="">{{$callFlooder->created_at}}</td>
			            <td class="last">
			            	<a href="{!! url('/callFlooders/call/'.$callFlooder->id); !!}">
				            	<button type="button" class="btn  btn-info" data-toggle="tooltip" title="Call">
				            		<i class="fa fa-phone" aria-hidden="true"></i>
				            	</button>
			            	</a>
			            	<a href="{{ route('callFlooders.edit',$callFlooder->id) }}">
				            	<button type="button" class="btn  btn-success" data-toggle="tooltip" title="Edit" id="{{$callFlooder->id}}">
				            		<i class="fa fa-pencil-square-o fa-1x" aria-hidden="true"></i>
				            	</button>
			            	</a>
			            	<button type="button" class="btn btn-danger cf-delete-btn" data-toggle="tooltip" title="Delete" id="{{ $callFlooder->id }}">
			            		<i class="fa fa-trash-o fa-1x" aria-hidden="true"></i>
			            	</button>
			            </td>
			          </tr>
		          	@endforeach
		        </tbody>
		      </table>
		    </div>
		  </div>
		  <div class="text-center">
			{!! $callFlooders->links(); !!}
		  </div>

		  {{-- hidden item --}}
		  <input type="hidden" name="_token" value="{{ csrf_token() }}">		  
		</div>
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

		    $('.cf-delete-btn').on('click', function (e) {
		        e.preventDefault();
		        var id = $(this).attr('id');

				var myJsonData = {id: id}
				$.post("{!! url('/callFlooders/postAjaxDelete'); !!}", myJsonData, function(response) {
				    if(response.status=='success'){
				    	$("#row_"+id).remove();
				    }
				});
		    });
		});		

	</script>
@endpush