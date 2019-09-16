@extends('admin.layouts.dashboard-template')
@section('title','New Student')
@section('content')
<div class="row mb-2">
	<div class="col-lg-12">
		@if(\Session::has('success'))
			@include('templates.student_create_success')
		@else
			@include('templates.error')
		@endif
	</div>
</div>

<form method="POST" action="{{ route('student.store') }}" id="#addStudentForm">
	@csrf
	<div class="row">
		<div class="col-lg-6">
			<div class="card shadow mb-4 rounded-0">
				<div class="card-header py-3 rounded-0">
					<h6 class="m-0 font-weight-bold text-primary">Personal Information</h6>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentFullname">Fullname</label>
								<input type="text" class="form-control" name="name" id="studentFullname" placeholder="Enter Fullname..." value="Christopher Vistal">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="studentGender" >Gender</label>
								<select name="gender" class="form-control" id="studentGender">
									<option value="male">Male</option>
									<option value="female">Female</option>
								</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label for="studentLevel">Year Level</label>
								<input type="number" class="form-control" name="level" id="studentLevel" value="1">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentCourse">Course</label>
								<select name="course_id" class="form-control" id="studentCourse">
									@foreach($courses as $course)
									<option value="{{$course->id}}">{{ $course->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentBirthDate">Birthdate</label>
								<input type="date" class="form-control" name="birthdate" value="1997-01-06">
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="card shadow mb-4 rounded-0">
				<div class="card-header py-3 rounded-0">
					<h6 class="m-0 font-weight-bold text-primary">Account Information</h6>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="studentIdNumber">ID Number</label>
								<input type="number" class="form-control" name="id_number" id="studentIdNumber" placeholder="Enter Student ID Number..." value="{{ rand(10000,100000) }}">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentPassword">Password</label>
								<input type="password" class="form-control" name="password" id="studentPassword" placeholder="Enter Your password..." value="1234">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentRetypePassword">Re-type password</label>
								<input type="password" class="form-control" name="password_confirmation" id="studentRetypePassword" placeholder="Password Confirmation..." value="1234">
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