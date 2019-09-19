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
							<label for="name">Subject name</label>
							<input type="text" class="form-control" value="{{ $subject->name }}" id="name" name="name">
						</div>
						<div class="col-lg-12 form-group">
							<label for="description">Subject Description</label>
							<input type="text" value="{{ $subject->description }}" class="form-control" id="description" name="description">
						</div>
						<div class="col-lg-4 form-group">
							<label for="level">Subject level</label>
							<input type="number" value="{{ $subject->level }}" class="form-control" id="level" name="level">
						</div>
						<div class="col-lg-4 form-group">
							<label for="level">Subject Credits</label>
							<input type="number" value="{{ $subject->credits }}" class="form-control" id="credits" name="credits">
						</div>
						<div class="col-lg-4 form-group">
							<label for="semester">Subject Semester</label>
							<input type="number" value="{{ $subject->semester }}" class="form-control" id="semester" name="semester">
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