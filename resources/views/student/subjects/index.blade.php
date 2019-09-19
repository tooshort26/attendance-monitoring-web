@extends('student.layouts.dashboard-template')
@section('title','List of your subjects')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endprepend
@foreach($subjects as $level => $year)
<div class="card shadow mb-4 rounded-0">
	@php
		$semesters = ['First' , 'Second', 'Third'];
		$years = ['1st' , '2nd', '3rd', '4th', '5th'];
	@endphp
	<div class="card-header py-3 rounded-0">
		@php $level--; @endphp
		<h6 class="m-0 font-weight-bold text-primary"> {{ $years[$level] }} Year</h6>
	</div>
	<div class="card-body">
		@foreach($year as $semester => $subject)
		@php $semester--; @endphp

		<h6 class="p-2 m-0 font-weight-bold">{{ $semesters[$semester] }} semester</h6>
		
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>Remarks</th>
				</tr>
			</thead>
			@foreach($subject as $items)
			<tbody>
				<tr>
					<td> {{ $items->name }}</td>
					<td> {{ $items->description }}</td>
					<td> {{ $items->pivot->remarks }}</td>
				</tr>
			</tbody>
			@endforeach
		</table>
		@endforeach
	</div>
</div>
@endforeach
@push('page-scripts')
<script src="{{ URL::asset("vendor/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ URL::asset("vendor/datatables/dataTables.bootstrap4.min.js") }}"></script>
<script></script>
@endpush
@endsection