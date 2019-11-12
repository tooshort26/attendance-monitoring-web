@extends('admin.layouts.dashboard-template')
@prepend('page-css')
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endprepend
@section('title','List of students')
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
  </div>
  <div class="card-body">
      <table id="students" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID Number</th>
          <th>Firstname</th>
          <th>Middlename</th>
          <th>Lastname</th>
          <th>Course</th>
        </tr>
      </thead>
    </table>
  </div>
</div>


@push('page-scripts')
  <!-- Page level plugins -->
  <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="https://unpkg.com/@feathersjs/client@^4.3.0/dist/feathers.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
  <script>
    let table = $('#students').DataTable( {
          ajax: {
              url : 'http://localhost:3030/students',
              cache: true,
              dataSrc : '',
          },
          columns: [
              { data : 'id_number' },
              { data : 'firstname' },
              { data : 'middlename' },
              { data : 'lastname' },
              { data : 'course' },
          ]
      });
        // Socket.io setup
       const socket = io('localhost:3030');

       // Init feathers app
       const app = feathers();

       // Register socket.io to talk to server
       app.configure(feathers.socketio(socket));

        function renderStudents() {
            table.ajax.reload();
        }

       async function init() {
          // Find instructors
          const students = await app.service('students').find();
          renderStudents();
          // Add idea in realtime
          app.service('students').on('created', renderStudents);
       }
       init();
  </script>

@endpush
@endsection
