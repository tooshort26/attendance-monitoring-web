@extends('admin.layouts.dashboard-template')
@section('title','New Instructor')
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
<form method="POST" action="{{ route('instructor.store') }}" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-lg-12">
			<div class="card shadow mb-4 rounded-0">
				<div class="card-header py-3 rounded-0">
					<h6 class="m-0 font-weight-bold text-primary">Instructor Information</h6>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="idNumber">ID Number</label>
								<input type="number" class="form-control" name="id_number" value="{{ old('id_number') }}" id="idNumber" placeholder="Enter ID Number...">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" name="password" value="{{ old('password') }}" id="password" placeholder="Enter Your password..." >
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="retypePassword">Re-type password</label>
								<input type="password" class="form-control" value="{{ old('password_confirmation') }}" name="password_confirmation" id="retypePassword" placeholder="Password Confirmation..." >
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="fullname">Fullname</label>
								<input type="text" class="form-control" name="name" id="fullname" placeholder="Enter Fullname..." value="{{ old('name') }}">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentGender">Gender</label>
								<select name="gender" class="form-control" id="studentGender">
									<option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
									<option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentBirthDate">Birthdate</label>
								<input type="date" class="form-control" value="{{ old('birthdate') }}" name="birthdate" >
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Profile Picture</label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="customFile" name="profile">
									<label class="custom-file-label" for="customFile">Instructor Image</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="float-right">
		<input type="submit" value="Add Instructor" class="btn btn-primary font-weight-bold">
	</div>
</form>
@endsection