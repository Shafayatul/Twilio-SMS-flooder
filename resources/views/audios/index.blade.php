@extends('master')
@section('content')  
<div class="row">
	<div class="col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
		    <h2>All Audio</h2>
		    <div class="clearfix"></div>
		  </div>

		  <div class="x_content">

		   <div class="table-responsive">
		      <table class="table table-striped jambo_table bulk_action text-center">
		        <thead>
		          <tr>
		            <th class="column-title text-center">ID </th>
		            <th class="column-title text-center">Name </th>
		            <th class="column-title text-center">Date </th>
		            <th class="column-title no-link last text-center"> Actions </th>
		          </tr>
		        </thead>

		        <tbody>
		        @foreach($audios as $audio)
		          <tr id="row_{{$audio->id}}">
		            <td class="">{{$audio->id}}</td>
		            <td class="">{{$audio->name}}</td>
		            <td class="">{{$audio->created_at}}</td>
		            <td class="last">
		            	<a href="{{ route('audios.edit',$audio->id) }}">
			            	<button type="button" class="btn  btn-success" data-toggle="tooltip" title="Edit" id="{{$audio->id}}">
			            		<i class="fa fa-pencil-square-o fa-1x" aria-hidden="true"></i>
			            	</button>
		            	</a>
		            	<button type="button" class="btn btn-danger cf-delete-btn" data-toggle="tooltip" title="Delete" id="{{ $audio->id }}">
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
			{!! $audios->links(); !!}
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
				
				$.post("{!! url('/audios/postAjaxDelete'); !!}", myJsonData, function(response) {
				    if(response.status=='success'){
				    	$("#row_"+id).remove();
				    }
				});
		    });
		});		

	</script>
@endpush
