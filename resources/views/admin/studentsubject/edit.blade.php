@extends('admin.layouts.dashboard-template')
@section('title','Edit subject for ' . ucwords($student->name))
@section('content')
<div class="row mb-2">
	<div class="col-lg-12">
		@if(\Session::has('success'))
			@include('templates.success')
		@else
			@include('templates.error')
		@endif
	</div>
</div>
@foreach($subjects as $level => $subject)
<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4 rounded-0">
			<div class="card-header py-3 rounded-0">
				<h6 class="m-0 font-weight-bold text-primary">{{ $level }} level</h6>
			</div>
			<div class="card-body" >
				
						@foreach($subject as $semester => $items)
							<span>{{ $semester }} semester</span>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Subject Name</th>
										<th>Subject Description</th>
										<th>Subject Level</th>
										<th>Subject Semester</th>
										<th>Subject Remarks</th>
									</tr>
								</thead>
								<tbody>
									@foreach($items as $item)
										<tr>
											<td>{{ $item['name'] }}</td>
											<td>{{ $item['description'] }}</td>
											<td>{{ $item['level'] }}</td>
											<td>{{ $item['semester'] }}</td>
											<td>{{ $item['pivot']['remarks'] }}</td>
										</tr>	
									@endforeach
								</tbody>
							</table>
						@endforeach
					
				{{-- <hr>
					<div class="float-right">
						<input type="submit" class="btn btn-primary mt-1 font-weight-bold" value="Add Subjects">
					</div> --}}
			</div>
		</div>
	</div>
</div>
@endforeach
@endsection