@extends('admin.layouts.dashboard-template')
@prepend('page-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.css" integrity="sha256-HF310xdxXK7TJqGFC69nzYYGbuxJO6MErjHdlhD2ZBU=" crossorigin="anonymous" />
@endprepend
@section('title','Add new instructor')
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
  </div>
  <div class="card-body">
        <form id="addInstructorForm">
            <div class="row">
              <div class="col">
                <label>ID Number</label>
                <input type="text" id="instructorIdNumber" required class="form-control" placeholder="ID Number">
              </div>
              <div class="col">
                <label>Email</label>
                <input type="email" id="instructorEmail"  required class="form-control" placeholder="Email Address">
              </div>
            </div>
            <br>
            <div class="row">
               <div class="col">
                <label>Firstname</label>
                <input type="text" id="instructorFirstname"  required class="form-control" placeholder="First name">
              </div>
              <div class="col">
                <label>M.I</label>
                <input type="text" id="instructorMiddleName"  required class="form-control" placeholder="Middle name">
              </div>
              <div class="col">
                <label>Lastname</label>
                <input type="text" id="instructorLastName" required  class="form-control" placeholder="Last name">
              </div>
            </div>
            
            <div class="float-right mt-3">
              <input type="submit" value="Add new instructor" class="btn btn-primary" id="add-new-instructor">
            </div>
          </form>
          <button id="qrGenerate">generate qr code</button>
          <div id="result"></div>
  </div>
</div>

@push('page-scripts')
<script src="https://unpkg.com/@zxing/library@0.15.2/umd/index.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha256-tSRROoGfGWTveRpDHFiWVz+UXt+xKNe90wwGn25lpw8=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@feathersjs/client@^4.3.0/dist/feathers.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
<script>

  document.querySelector('#qrGenerate').addEventListener('click', () => {
    const codeWriter = new ZXing.BrowserQRCodeSvgWriter();
    // you can get a SVG element.
    // const svgElement = codeWriter.write(input, 300, 300);
    // or render it directly to DOM.
    codeWriter.writeToDom('#result', 'sample', 300, 300);
  });
  
    // Socket.io setup
       const socket = io('http://192.168.1.11:3030');

       // Init feathers app
       const app = feathers();

       // Register socket.io to talk to server
       app.configure(feathers.socketio(socket));

       // Instructor form
       const addInstructorForm = document.querySelector('#addInstructorForm');

       addInstructorForm.addEventListener('submit', addInstructor);

       async function addInstructor(e) {
           e.preventDefault();
           const idNumber   = document.querySelector('#instructorIdNumber');
           const firstname  = document.querySelector('#instructorFirstname');
           const middlename = document.querySelector('#instructorMiddleName');
           const lastname   = document.querySelector('#instructorLastName');
           const email      = document.querySelector('#instructorEmail');


        
               app.service('instructors').create({
                  id_number  : idNumber.value,
                  firstname  : firstname.value,
                  middlename : middlename.value,
                  lastname   : lastname.value,
                  email      : email.value
              });

              idNumber.value = '';
              firstname.value = '';
              middlename.value = '';
              lastname.value = '';
              email.value = '';

              $('#add-new-instructor').notify('Succesfully add.', 'success', { position:'left' });
          

         
       }
</script>
@endpush
@endsection