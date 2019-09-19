@extends('instructor.layouts.dashboard-template')
@section('title','List of your student')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endprepend
<div class="card shadow mb-4 rounded-0">
	<div class="card-header py-3 rounded-0">
		<h6 class="m-0 font-weight-bold text-primary">Students</h6>
	</div>

	<div class="card-body">
		<table class="table table-bordered table-hover" id="student-subjects-table">
			<thead>
				<tr>
					<th>ID Number</th>
					<th>Name</th>
					<th class="text-center">Course</th>
					<th class="text-center">Department</th>
					<th class="text-center">Remarks</th>
				</tr>
			</thead>
			<tbody>
				@foreach($students as $student)
				<tr>
					<td>{{ $student->id_number }}</td>
					<td>{{ $student->name }}</td>
					<td class="text-center">{{ $student->course->abbr }}</td>
					<td class="text-center">{{ $student->course->department->name }}</td>
					<td class="text-center">{{ $student->subjects[0]->pivot->remarks }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>


@push('page-scripts')
<script src="{{ URL::asset("vendor/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ URL::asset("vendor/datatables/dataTables.bootstrap4.min.js") }}"></script>
<script>
 $('#student-subjects-table').DataTable();
</script>
@endpush
@endsection