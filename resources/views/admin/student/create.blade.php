@extends('admin.layouts.dashboard-template')
@section('title','New Student')
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

<form method="POST" action="{{ route('student.store') }}" id="#addStudentForm">
	@csrf
	<div class="row">
		<div class="col-lg-12">
			<div class="card shadow mb-4 rounded-0">
				<div class="card-header py-3 rounded-0">
					<h6 class="m-0 font-weight-bold text-primary">Personal Information & Credentials</h6>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentFullname">Fullname</label>
								<input type="text" class="form-control" name="name" id="studentFullname" placeholder="Enter Fullname..." value="{{ old('name') }}">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentGender" >Gender</label>
								<select name="gender" class="form-control" id="studentGender">
									<option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
									<option value="female" {{ old('gender') =='female' ? 'selected' : '' }}>Female</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentCourse">Course</label>
								<select name="course_id" class="form-control" id="studentCourse">
									@foreach($courses as $course)
									<option value="{{$course->id}}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentBirthDate">Birthdate</label>
								<input type="date" class="form-control" name="birthdate" value={{ old('birthdate') }}>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentPassword">Password</label>
								<input type="password" class="form-control" name="password" id="studentPassword" placeholder="Enter Your password..." >
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentRetypePassword">Re-type password</label>
								<input type="password" class="form-control" name="password_confirmation" id="studentRetypePassword" placeholder="Password Confirmation..." >
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="float-right">
		<input type="submit" value="Add Student" class="btn btn-primary font-weight-bold">
	</div>
</form>
@endsection