@extends('admin.layouts.dashboard-template')
@section('title','List of course')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endprepend
<div class="card shadow mb-4 rounded-0">
	<div class="card-header py-3 rounded-0">
		<h6 class="m-0 font-weight-bold text-primary">Course</h6>
	</div>

	<div class="card-body">
		<button data-target="#addCourseModal" data-toggle="modal" class="btn btn-primary btn-sm mb-2 text-center text-white  float-right font-weight-bold"><i class="fa fa-plus"></i> Add Course</button>
		<div class="clearfix"></div>
		<table class="table table-bordered table-hover" id="courses-table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Short name</th>
					<th>Department</th>
					<th>Action</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<!-- EDIT COURSE MODAL -->
<div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog" aria-labelledby="editCourseModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCourseModalLabel">Edit Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="modalFormEditCourse">
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-lg-12">
	      			<div class="form-group">
	      				<label for="courseName">Course Name :</label>
	      				<input type="text" name="name" id="courseName" class="form-control">
	      			</div>
	      		</div>

	      		<div class="col-lg-12">
	      			<div class="form-group">
	      				<label for="courseShortname">Short Name :</label>
	      				<input type="text" name="abbr" id="courseShortname" class="form-control">
	      			</div>
	      		</div>
				
				<div class="col-lg-12">
	      			<div class="form-group">
	      				<label for="department">Department :</label>
	      				<select name="department_id" id="department" class="form-control">
		      				@foreach($departments as $department)
		      					<option value="{{$department->id}}">{{ $department->name }}</option>
		      				@endforeach
	      				</select>
	      			</div>
	      		</div>

	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<!-- ADD COURSE MODAL -->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCourseModalLabel">Add Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="modalFormAddCourse">
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-lg-12">
	      			<div class="form-group">
	      				<label for="addCourseName">Course Name :</label>
	      				<input type="text" name="name" id="addCourseName" class="form-control">
	      			</div>
	      		</div>

	      		<div class="col-lg-12">
	      			<div class="form-group">
	      				<label for="addCourseShortname">Short Name :</label>
	      				<input type="text" name="abbr" id="addCourseShortname" class="form-control">
	      			</div>
	      		</div>
				
				<div class="col-lg-12">
	      			<div class="form-group">
	      				<label for="department">Department :</label>
	      				<select name="department_id" id="addCourseDepartment" class="form-control">
		      				@foreach($departments as $department)
		      					<option value="{{$department->id}}">{{ $department->name }}</option>
		      				@endforeach
	      				</select>
	      			</div>
	      		</div>

	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Add course</button>
	      </div>
      </form>
    </div>
  </div>
</div>
@push('page-scripts')
<script src="{{ URL::asset("vendor/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ URL::asset("vendor/datatables/dataTables.bootstrap4.min.js") }}"></script>
<script>
	let courseId = "";
	let courseName       = document.querySelector('#courseName');
	let courseShortName  = document.querySelector('#courseShortname');
	let courseDepartment = document.querySelector('#department');

	$.ajaxSetup({
	    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
	});

	$('#courses-table').DataTable({
	    orderCellsTop: true,
	    serverSide: true,
	    processing: true,
	    responsive: true,
	    ajax: '/admin/course/list',
	    columns: [
	        { name: 'name' },
	        { name: 'abbr' },
	        { name: 'department.name' , searchable : true },
	        { name: 'action' , searchable: false },
	    ],
	});

	const requestByAjax = (type, route , data, modal) => {
		$.ajax({
			   url: route,
			   type: type,
			   data : data,
			   success: function(response) {
			   		if (response.success) {
			   			$('#courses-table').DataTable().ajax.reload();
			   			if (confirm('Want to view the record?')) {
			   				$(modal).modal('toggle');
			   			}
			   		}
			   },
			  statusCode : {
			  	422 : function (response) {
			  		let formMessages = Object.values(response.responseJSON.errors);
			  		let messages = "";

			  		formMessages.forEach((message) => {
			  			messages += message[0]  + "\n";
			  		});

			  		alert(messages);
			  	}
			  }	
		});
	};

	const editCourse = (e) => {
		let courseInfo = JSON.parse(e.getAttribute('data-src'));
		courseId              = courseInfo.id;
		courseName.value      = courseInfo.name;
		courseShortname.value = courseInfo.abbr;
		department.value      = courseInfo.department_id;
		$('#editCourseModal').modal('toggle');
	};


	document.querySelector('#modalFormEditCourse').addEventListener('submit', (e) => {
		e.preventDefault();
		let data = {name : courseName.value , abbr : courseShortname.value, department_id : department.value , id: courseId};
		requestByAjax('PUT', `/admin/course/${courseId}`, data, '#editCourseModal');
	});

	document.querySelector('#modalFormAddCourse').addEventListener('submit', (e) => {
		e.preventDefault();
		let name = document.querySelector('#addCourseName').value;
		let abbr = document.querySelector('#addCourseShortname').value;
		let department_id = document.querySelector('#addCourseDepartment').value;
		let data = {name , abbr , department_id};
		requestByAjax('POST', `/admin/course`, data, '#addCourseModal');
	});

	


</script>
@endpush
@endsection