@extends('admin.layouts.dashboard-template')
@section('title','Edit Instructor')
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
<form method="POST" action="{{ route('instructor.update', [$instructor]) }}" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<div class="row">
		<div class="col-lg-12">
			<div class="card shadow mb-4 rounded-0">
				<div class="card-header py-3 rounded-0">
					<h6 class="m-0 font-weight-bold text-primary">{{ $instructor->name }} Information</h6>
				</div>
				<div class="card-body">
					<div class="row">
						<input type="hidden" name="id" value="{{$instructor->id}}">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="studentIdNumber">ID Number</label>
								<input type="number" class="form-control" name="id_number" id="studentIdNumber" placeholder="Enter Student ID Number..." value="{{ $instructor->id_number }}">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentPassword">New password (Optional)</label>
								<input type="password" class="form-control" name="password" id="studentPassword" placeholder="Enter Your password..." value="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentRetypePassword">Re-type new password <small class="text-primary font-weight-bold">(Fill this if you fill the new password field)</small></label>
								<input type="password" class="form-control" name="password_confirmation" id="studentRetypePassword" placeholder="Password Confirmation..." value="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentFullname">Fullname</label>
								<input type="text" class="form-control" name="name" id="studentFullname" placeholder="Enter Fullname..." value="{{ $instructor->name }}">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentGender" >Gender</label>
								<select name="gender" class="form-control" id="studentGender">
									<option value="male" {{ $instructor->gender === 'male' ? 'selected' : ''}}>Male</option>
									<option value="female" {{ $instructor->gender === 'female' ? 'selected' : ''}}>Female</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="studentBirthDate">Birthdate</label>
								<input type="date" class="form-control" name="birthdate" value="{{$instructor->birthdate}}">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Profile Picture (Optional)</label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="customFile" name="profile">
									<label class="custom-file-label" for="customFile">New profile image</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="float-right">
		<input type="submit" value="Update Instructor" class="btn btn-success font-weight-bold">
	</div>
</form>
@endsection