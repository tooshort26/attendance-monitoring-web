@extends('admin.layouts.dashboard-template')
@prepend('page-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.css" integrity="sha256-HF310xdxXK7TJqGFC69nzYYGbuxJO6MErjHdlhD2ZBU=" crossorigin="anonymous" />
@endprepend
@section('title','Add new student')
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
  </div>
  <div class="card-body">
        <form id="addStudentForm">
            <div class="row">
              <div class="col">
                <label>ID Number</label>
                <input type="text" id="studentIdNumber" class="form-control" placeholder="ID Number">
              </div>
              <div class="col">
                <label>Course</label>
                <select id="studentCourse" class="form-control">
                  <option value="BSCS">Bachelor of Science in Computer Science</option>
                </select>
              </div>
            </div>
            <br>
            <div class="row">
               <div class="col">
                <label>Firstname</label>
                <input type="text" id="studentFirstname" class="form-control" placeholder="First name">
              </div>
              <div class="col">
                <label>M.I</label>
                <input type="text" id="studentMiddleName" class="form-control" placeholder="Middle name">
              </div>
              <div class="col">
                <label>Lastname</label>
                <input type="text" id="studentLastName" class="form-control" placeholder="Last name">
              </div>
            </div>
            
            <div class="float-right mt-3">
              <input type="submit" value="Add new student" class="btn btn-primary" id="add-new-student">
            </div>
          </form>  
  </div>
</div>

@push('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha256-tSRROoGfGWTveRpDHFiWVz+UXt+xKNe90wwGn25lpw8=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@feathersjs/client@^4.3.0/dist/feathers.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
<script>
  
    // Socket.io setup
       const socket = io('localhost:3030');

       // Init feathers app
       const app = feathers();

       // Register socket.io to talk to server
       app.configure(feathers.socketio(socket));

       // Instructor form
       const addStudentForm = document.querySelector('#addStudentForm');

       addStudentForm.addEventListener('submit', addStudent);

       async function addStudent(e) {
           e.preventDefault();
           
           const idNumber   = document.querySelector('#studentIdNumber');
           const firstname  = document.querySelector('#studentFirstname');
           const middlename = document.querySelector('#studentMiddleName');
           const lastname   = document.querySelector('#studentLastName');
           const course     = document.querySelector('#studentCourse');

          app.service('students').create({
              id_number  : idNumber.value,
              firstname  : firstname.value,
              middlename : middlename.value,
              lastname   : lastname.value,
              course      : studentCourse.value
          });

          idNumber.value = '';
          firstname.value = '';
          middlename.value = '';
          lastname.value = '';

          $('#add-new-student').notify('Succesfully add.', 'success', { position:'left' });
       }
</script>
@endpush
@endsection