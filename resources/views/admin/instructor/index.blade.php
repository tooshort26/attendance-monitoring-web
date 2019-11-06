@extends('admin.layouts.dashboard-template')
@prepend('page-css')
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endprepend
@section('title','List of instructors')
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
  </div>
  <div class="card-body">
      <table id="instructors" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>QR Code</th>
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
    let table = $('#instructors').DataTable( {
          ajax: {
              url : 'http://192.168.1.11:3030/instructors',
              cache: true,
              dataSrc : '',
          },
          columns: [
              { data : 'name' },
              { data : 'description' },
              { data : 'description' },
          ]
      });
        // Socket.io setup
       const socket = io('http://192.168.1.11:3030');

       // Init feathers app
       const app = feathers();

       // Register socket.io to talk to server
       app.configure(feathers.socketio(socket));

        function renderInstructor() {
            table.ajax.reload();
        }

         async function init() {
          // Find instructors
          const instructors = await app.service('instructors').find();
          renderInstructor();
          // Add idea in realtime
          app.service('instructors').on('created', renderInstructor);
       }
       init();
  </script>

@endpush
@endsection
