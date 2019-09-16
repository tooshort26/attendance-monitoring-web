@extends('admin.layouts.dashboard-template')
@section('title','List of student')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endprepend
<div class="card shadow mb-4 rounded-0">
	<div class="card-header py-3 rounded-0">
		<h6 class="m-0 font-weight-bold text-primary">Students</h6>
	</div>
	<div class="card-body">
		<table class="table table-bordered table-hover" id="students-table">
			<thead>
				<tr>
					<th>ID Number</th>
					<th>Name</th>
					<th>Gender</th>
					<th>Birthdate</th>
					<th>Course</th>
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
	$('#students-table').DataTable({
    orderCellsTop: true,
    serverSide: true,
    processing: true,
    responsive: true,
    ajax: '/admin/student/list',
    columns: [
        { name: 'id_number' },
        { name: 'name' },
        { name: 'gender' },
        { name: 'birthdate' },
        { name: 'course.name', orderable: false },
         { name: 'action', orderable: false, searchable: false }
    ],
});
</script>
@endpush
@endsection