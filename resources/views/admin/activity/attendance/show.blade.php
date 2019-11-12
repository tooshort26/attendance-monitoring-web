@extends('admin.layouts.dashboard-template')
@prepend('page-css')
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endprepend
@section('title','Attendance')
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
  </div>
  <div class="card-body">
         <table id="attendances" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID Number</th>
              <th>Fullname</th>
              <th>Course</th>
            </tr>
          </thead>
        </table>
  </div>
</div>

<button id="sample">Click me!</button>
@push('page-scripts')
  <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
       const activityId = "{{ $id }}";

        // Socket.io setup
       const socket = io('localhost:3030');

       // Init feathers app
       const app = feathers();

       // Register socket.io to talk to server
       app.configure(feathers.socketio(socket));


        let table = $('#attendances').DataTable( {
          ajax: {
              url : `http://localhost:3030/attendances/${activityId}`,
              cache: true,
              dataSrc : '',
          },
          columns: [
              { data : 'id_number' },
              {
                 render : function ( data, type, full, meta) {
                     return `${full.firstname} ${full.middlename} ${full.lastname}`;
                 }
             },
              { data : 'course' }
          ]
      });

      function renderNewStudentAttendance() {
          table.ajax.reload();
      }

      $('#sample').click(function () {
        app.service('attendances').create({
              id_number  : 8,
              activity_id : activityId,
          });
      });

       async function init() {
          const activity = await app.service('/activities').get(activityId);
          app.service('attendances').on('created', (attendance) => {
              renderNewStudentAttendance();
              toastr.success(`${attendance.firstname} ${attendance.lastname} attend ${attendance.name} - ${attendance.description} .`, 'Activity Attendance', {timeOut: 6000});
          });
       }
       init();
</script>
@endpush
@endsection