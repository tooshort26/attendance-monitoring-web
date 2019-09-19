@extends('admin.layouts.dashboard-template')
@section('title','Update your information')
@section('content')
<div class="row">
	<div class="col-lg-12 mb-2">
		@if(\Session::has('success'))
			@include('templates.success')
		@else
			@include('templates.error')
		@endif
	</div>

</div>
<form method="POST" action="{{ route('admin.update', [Auth::user()->id]) }}" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<div class="card shadow mb-4 rounded-0">
		<div class="card-header py-3 rounded-0">
			<h6 class="m-0 font-weight-bold text-primary">{{ Auth::user()->name }} Information</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="adminIdNumber">ID Number</label>
						<input type="number" class="form-control" name="id_number" id="adminIdNumber" value="{{ Auth::user()->id_number }}">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label for="adminFullname">Fullname</label>
						<input type="text" class="form-control" name="name" id="adminFullname" value="{{ Auth::user()->name }}">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label for="adminNewPassword">New Password</label>
						<input type="password" class="form-control" name="password" id="adminNewPassword" >
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label for="adminPasswordConfirmation">Re-type new password</label>
						<input type="password" class="form-control" name="password_confirmation" id="adminPasswordConfirmation" >
					</div>
				</div>

				<div class="col-lg-12">
					<div class="form-group">
						<label>Profile Picture</label>
						  <div class="custom-file">
						    <input type="file" class="custom-file-input" id="customFile" name="profile">
						    <label class="custom-file-label" for="customFile">Choose a file</label>
						  </div>
					</div>
				</div>
					
			</div>
		</div>
	</div>

	<div class="float-right">
		<input type="submit" value="Update Administrator Information" class="btn btn-success font-weight-bold">
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