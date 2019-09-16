@extends('admin.layouts.dashboard-template')
@section('title','List of instructor')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endprepend
<div class="card shadow mb-4 rounded-0">
	<div class="card-header py-3 rounded-0">
		<h6 class="m-0 font-weight-bold text-primary">Instructors</h6>
	</div>
	<div class="card-body">
		<table class="table table-bordered table-hover" id="instructors-table">
			<thead>
				<tr>
					<th>ID Number</th>
					<th>Name</th>
					<th>Gender</th>
					<th>Birthdate</th>
					<th>Actions</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
@push('page-scripts')
<script src="{{ URL::asset("vendor/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ URL::asset("vendor/datatables/dataTables.bootstrap4.min.js") }}"></script>
<script>
	$('#instructors-table').DataTable({
    orderCellsTop: true,
    serverSide: true,
    processing: true,
    responsive: true,
    ajax: '/admin/instructor/list',
    columns: [
        { name: 'id_number' },
        { name: 'name' },
        { name: 'gender' },
        { name: 'birthdate' },
        { name: 'action', orderable: false, searchable: false }
    ],
});
</script>
<script>
	$.ajaxSetup({
	    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
	});
	function inActiveInstructor(instructorId)
	{
		let confirmation = confirm('Are you sure you want to mark this instructor as in-active?');
		
		if ( confirmation ) {
			$.ajax({
			   url: `/admin/instructor/${instructorId}`,
			   type: 'DELETE',
			   success: function(response) {
			   		if (response.success) {
			   			$('#instructors-table').DataTable().ajax.reload();
			   		}
			   }
			});
		}
	}
</script>
@endpush
@endsection