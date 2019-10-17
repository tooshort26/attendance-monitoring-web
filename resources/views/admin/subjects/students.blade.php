@extends('admin.layouts.dashboard-template')
@section('title','List of students in ' . $subject->name . ' - ' . $subject->description)
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.css">
@endprepend
<div class="card shadow mb-4 rounded-0">
	<div class="card-header py-3 rounded-0">
		<h6 class="m-0 font-weight-bold text-primary">Students in {{ $subject->name }}</h6>
	</div>
	<div class="card-body">
		<table class="table table-bordered table-hover" id="students-in-subject-table">
			<thead>
				<tr>
					<th>ID Number</th>
					<th>Name</th>
					<th>Course</th>
					<th>Department</th>
				</tr>
			</thead>
			<tbody>
				@foreach($subject->students as $student)
				<tr>
					<td>{{ $student->id_number }}</td>
					<td>{{ $student->name }}</td>
					<td>{{ $student->course->abbr }}</td>
					<td>{{ $student->course->department->name }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.3/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
	let table = $('#students-in-subject-table').DataTable();
</script>
@endpush
@endsection