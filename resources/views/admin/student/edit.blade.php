@extends('admin.layouts.dashboard-template')
@section('title','Update student information')
@section('content')
<div class="row">
	<div class="col-lg-12">
		@if(\Session::has('success'))
			@include('templates.success')
		@else
			@include('templates.error')
		@endif
	</div>

</div>
<div class="float-right">
		<a href="{{ route('student.subject.create', [$student]) }}" class="mt-3 mb-3 font-weight-bold btn btn-primary">Add Subjects</a>
		<a href="{{ route('student.subject.edit', [$student]) }}" class="mt-3 mb-3 font-weight-bold btn btn-info">Edit Subjects</a>
</div>
<div class="clearfix"></div>

<form method="POST" action="{{ route('student.update', ['student' => $student]) }}" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<input type="hidden" name="id" value="{{$student->id}}">
	<div class="card shadow mb-4 rounded-0">
		<div class="card-header py-3 rounded-0">
			<h6 class="m-0 font-weight-bold text-primary">Student Information</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="studentIdNumber">ID Number</label>
						<input type="number" class="form-control" name="id_number" id="studentIdNumber" value="{{ $student->id_number }}" placeholder="Enter Student ID Number...">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="studentFullname">Fullname</label>
						<input type="text" class="text-capitalize form-control" name="name" id="studentFullname" value="{{ $student->name }}" placeholder="Enter Fullname...">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="studentGender" >Gender</label>
						<select name="gender" class="form-control" id="studentGender">
							<option value="male" {{ $student->gender == 'male' ? 'selected' : null }}>Male</option>
							<option value="female" {{ $student->gender == 'female' ? 'selected' : null }} >Female</option>
						</select>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group">
						<label for="studentCourse">Course</label>
						<select name="course_id" class="form-control" id="studentCourse">
							@foreach($courses as $course)
							<option value="{{$course->id}}" {{$student->course_id === $course->id ? 'selected' : null }} >{{ $course->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group">
						<label for="studentLevel">Year Level</label>
						<input type="number" class="form-control" name="level" value="{{ $student->level }}" id="studentLevel">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="studentBirthdate">Birthdate</label>
						<input name="birthdate" type="date" class="form-control" id="studentBirthdate" value="{{$student->birthdate}}">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label>&nbsp;</label>
						  <div class="custom-file">
						    <input type="file" class="custom-file-input" id="customFile" name="profile">
						    <label class="custom-file-label" for="customFile">Student Image</label>
						  </div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label for="studentNewPassword">New password <small class="font-weight-bold text-primary">(optional)</small></label>
						<input name="password" type="password" class="form-control" id="studentNewPassword">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label for="studentRetypePassword">Re-type new password</label>
						<input name="password_confirmation" type="password" class="form-control" id="studentRetypePassword">
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="float-right">
		<input type="submit" value="Update Student Information" class="btn btn-success font-weight-bold">
	</div>
</form>
@push('page-scripts')
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  let fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

@endpush
@endsection