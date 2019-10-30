@extends('admin.layouts.dashboard-template')
@section('title','Edit subject')
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
<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4 rounded-0">
			<div class="card-header py-3 rounded-0">
				<h6 class="m-0 font-weight-bold text-primary">Edit subject</h6>
			</div>
			<div class="card-body" >
				<form action="{{ route('subject.update', [$subject]) }}" method="POST">
					@csrf
					@method('PUT')
					<input type="hidden" value="{{ $subject->id }}" name="id">
					<div class="row">
						<div class="col-lg-12 form-group">
							<label for="name">Course No.</label>
							<input type="text" class="form-control" value="{{ old('name') ?? $subject->name }}" id="name" name="name">
						</div>
						<div class="col-lg-6 form-group">
							<label for="description">Description</label>
							<input type="text" value="{{ old('description') ?? $subject->description }}" class="form-control" id="description" name="description">
						</div>

						<div class="col-lg-6 form-group">
							<label for="department">Department</label>
							<select name="department_id" class="form-control" id="department" required>
								<option value="" selected disabled hidden>Select Department</option>
								@foreach($departments as $department)
								<option {{ (old('department_id') == $department->id) ? 'selected' : $subject->department_id == $department->id ? 'selected' : '' }} value="{{ $department->id }}">{{ $department->name }}</option>
								@endforeach
							</select>
						</div>

						<div class="col-lg-3 form-group">
							<label for="level">Year Level</label>
							<input type="number" value="{{ old('level') ?? $subject->level }}" class="form-control" id="level" name="level">
						</div>
						<div class="col-lg-3 form-group">
							<label for="level">Units</label>
							<input type="number" value="{{ old('credits') ?? $subject->credits }}" class="form-control" id="credits" name="credits">
						</div>
						<div class="col-lg-3 form-group">
							<label for="semester">Semester</label>
							<input type="number" value="{{ old('semester') ?? $subject->semester }}" class="form-control" id="semester" name="semester">
						</div>
						<div class="col-lg-3 form-group">
							<label for="school_year">School Year</label>
							<input type="text" value="{{ old('school_year') ?? $subject->school_year }}" class="form-control" id="school_year" name="school_year">
						</div>
					</div>
					<div class="float-right">
						<input type="submit" class="btn btn-primary mt-1 font-weight-bold" value="Update Subject">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@push('page-scripts')
@endpush
@endsection