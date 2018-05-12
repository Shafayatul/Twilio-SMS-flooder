@extends('master')
@section('content')  
<div class="row">
	<div class="col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
		    <h2>All Schedule</h2>
		    <div class="clearfix"></div>
		  </div>
		  <div class="x_content">
		  	<div class="row">
		  		<div class="col-sm-12">

				   <div class="card-box table-responsive">
				      <table id="datatable-keytable" class="table table-striped table-bordered">
				        <thead>
				          <tr>
				            <th class="column-title text-center">ID </th>
				            <th class="column-title text-center">Name </th>
				            <th class="column-title text-center">Call Flooder </th>
				            <th class="column-title text-center">Minutes </th>
				            <th class="column-title text-center">Date </th>
				            <th class="column-title no-link last text-center"> Actions </th>
				          </tr>
				        </thead>

				        <tbody>
				        	@foreach($schedules as $schedule)
					          <tr id="row_{{$schedule->id}}">
					            <td class="">{{$schedule->id}}</td>
					            <td class="">{{$schedule->name}}</td>
					            <td class="">{{$callFlooders[$schedule->call_flooder_id]}}</td>
					            <td class="">{{$schedule->minutes}}</td>
					            <td class="">{{$schedule->date}}</td>
					            <td class="last">
					            	<a href="{!! url('/callFlooders/call/'.$schedule->call_flooder_id.'/'.$schedule->minutes); !!}">
						            	<button type="button" class="btn  btn-info" data-toggle="tooltip" title="Call">
						            		<i class="fa fa-phone" aria-hidden="true"></i>
						            	</button>
					            	</a>
					            	<a href="{{ route('schedules.edit',$schedule->id) }}">
						            	<button type="button" class="btn  btn-success" data-toggle="tooltip" title="Edit" id="{{$schedule->id}}">
						            		<i class="fa fa-pencil-square-o fa-1x" aria-hidden="true"></i>
						            	</button>
					            	</a>
					            	<button type="button" class="btn btn-danger cf-delete-btn" data-toggle="tooltip" title="Delete" id="{{ $schedule->id }}">
					            		<i class="fa fa-trash-o fa-1x" aria-hidden="true"></i>
					            	</button>
					            </td>
					          </tr>
				          @endforeach
				        </tbody>
				      </table>
				    </div>		  			
		  		</div>
		  	</div>
		  </div>
		</div>
	</div>
</div>

<!-- Datatables -->
<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

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
				
				$.post("{!! url('/schedules/postAjaxDelete'); !!}", myJsonData, function(response) {
				    if(response.status=='success'){
				    	$("#row_"+id).remove();
				    }
				});
		    });
		});		

	</script>

    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>	
@endpush