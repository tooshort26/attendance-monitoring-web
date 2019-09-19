@extends('admin.layouts.dashboard-template')
@section('title','List of subject')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endprepend
<div class="card shadow mb-4 rounded-0">
	<div class="card-header py-3 rounded-0">
		<h6 class="m-0 font-weight-bold text-primary">Subjects</h6>
	</div>
	<div class="card-body">
		<table class="table table-bordered table-hover" id="students-table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>Level</th>
					<th>Semester</th>
					<th class="text-center">Action</th>
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
    ajax: '/admin/subject/list',
    columns: [
        { name: 'name' },
        { name: 'description' },
        { name: 'level' },
        { name: 'semester' },
        { name: 'action' },
    ],
});
</script>
@endpush
@endsection