@extends('admin.layouts.dashboard-template')
@section('title','List of subject')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.css">
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
					<th>Credits</th>
					<th>Semester</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>
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
        { name: 'credits' },
        { name: 'semester' },
        { name: 'action' , searchable : false,},
    ],
});
</script>
@endpush
@endsection