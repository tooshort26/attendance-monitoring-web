@extends('admin.layouts.dashboard-template')
@section('title','Dashboard')
@section('content')
<div class="row">
	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">No of students</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800" id="students-count">
							<div class="spinner-border text-primary" role="status">
							  <span class="sr-only">Loading...</span>
							</div>
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-calendar fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">No of instructors</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800" id="instructors-count">
							<div class="spinner-border text-primary" role="status">
							  <span class="sr-only">Loading...</span>
							</div>
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-info shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-info text-uppercase mb-1">No of course</div>
						<div class="row no-gutters align-items-center">
							<div class="col-auto">
								<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0</div>
							</div>
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Pending Requests Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-warning shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">No of departments</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-comments fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@push('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha256-tSRROoGfGWTveRpDHFiWVz+UXt+xKNe90wwGn25lpw8=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@feathersjs/client@^4.3.0/dist/feathers.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
<script>
  
    // Socket.io setup
       const socket = io('http://192.168.1.11:3030');

       // Init feathers app
       const app = feathers();

       // Register socket.io to talk to server
       app.configure(feathers.socketio(socket));


       function initStudents(students) {
	    	document.querySelector('#students-count').innerHTML = students.length;
       }


       async function init() {
		  const students    = await app.service('students').find();
		  
          initStudents(students);

	        app.service('students').on('created', () => {
	          	let element = document.getElementById('students-count');
	        	let currentStudentCount = parseInt(element.innerText);
	        	element.innerHTML = currentStudentCount + 1;
	        });


	        socket.on('student-publish', function (data) {
	        	console.log(data);
	        });
       }

       init();
</script>
@endpush
@endsection
