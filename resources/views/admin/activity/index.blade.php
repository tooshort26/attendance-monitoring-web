@extends('admin.layouts.dashboard-template')
@prepend('page-css')
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.css" integrity="sha256-HF310xdxXK7TJqGFC69nzYYGbuxJO6MErjHdlhD2ZBU=" crossorigin="anonymous" /> --}}
@endprepend
@section('title','List of activities')
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
  </div>
  <div class="card-body">
      <table id="activities" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

    <!-- QR Code Modal Modal-->
    <div class="modal fade" id="viewQrCodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="viewQrCodeModalTitle"></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="qr-code-modal-body">
            
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editActivityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editActivityModalTitle"></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="editActivityId">
              <div class="row">
                <div class="col">
                  <input type="text" class="form-control" id="editActivityName"  placeholder="Activity name">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col">
                  <input type="text" class="form-control" id="editActivityDescription" placeholder="Activity Description">
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-success" type="button" id="btn-update-activity">Update</button>
          </div>
        </div>
      </div>
    </div>

@push('page-scripts')
  <!-- Page level plugins -->
  <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="https://unpkg.com/@feathersjs/client@^4.3.0/dist/feathers.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
  <script src="https://unpkg.com/@zxing/library@0.15.2/umd/index.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha256-tSRROoGfGWTveRpDHFiWVz+UXt+xKNe90wwGn25lpw8=" crossorigin="anonymous"></script>
  <script>
    let index = 0;
    let table = $('#activities').DataTable( {
          ajax: {
              url : 'http://192.168.1.11:3030/activities',
              cache: true,
              dataSrc : '',
          },
          columns: [
              { data : 'name' },
              { data : 'description' },
              {
                 sortable : false,
                 render : function ( data, type, full, meta) {
                  var data = JSON.stringify(full);
                     return `
                          <div class="text-center">
                            <button class='btn btn-sm font-weight-bold btn-success' onclick="editActivityModal(this)" data-src=${data}>Edit</button>
                            <button class='btn btn-sm font-weight-bold btn-primary' onclick="displayQrCode(this)" data-src=${data}>View QR Code</button>
                            <button class='btn btn-sm font-weight-bold btn-info'>Print QR Code</button>
                          </div>
                      `;
                 }
             },
          ]
      });
        // Socket.io setup
       const socket = io('http://192.168.1.11:3030');

       // Init feathers app
       const app = feathers();

       // Register socket.io to talk to server
       app.configure(feathers.socketio(socket));

        function renderActivities() {
            table.ajax.reload();
        }

         async function init() {
          // Find activities
          const activities = await app.service('activities').find();
          renderActivities();
          // Add idea in realtime
          app.service('activities').on('created', renderActivities);
          app.service('activities').on('updated', renderActivities);
       }
       init();


       function displayQrCode(e) {
          let activity = JSON.parse(e.getAttribute('data-src'));
          const codeWriter = new ZXing.BrowserQRCodeSvgWriter();
          const qrCodeModalBody = document.querySelector('#qr-code-modal-body');

          // To avoid duplication of barcode convert to png.
          qrCodeModalBody.innerHTML = '';
          qrCodeModalBody.innerHTML = `
              <div id="qrCodeContainer" class="text-center"></div>
              <canvas id="canvas" width="300" height="300" style="display:none;"></canvas>
          `;

          // Create QR Code base on the activity name
          codeWriter.writeToDom(qrCodeContainer, activity.name, 300, 300);

          // Convert QR Code to Image
            let svgString = new XMLSerializer().serializeToString(document.querySelector('svg'));
            let canvas = document.getElementById("canvas");
            let ctx = canvas.getContext("2d");
            let DOMURL = self.URL || self.webkitURL || self;
            let img = new Image();
            let svg = new Blob([svgString], {type: "image/svg+xml;charset=utf-8"});
            let url = DOMURL.createObjectURL(svg);

            img.onload = function() {
                  ctx.drawImage(img, 0, 0);
                  let png = canvas.toDataURL("image/png");
                  document.querySelector('#qrCodeContainer').innerHTML = `<img src="${png}"/>`;
                  DOMURL.revokeObjectURL(png);
              };

           img.src = url;
          $('#viewQrCodeModalTitle').html(`${activity.name} Qr Code`);
          $('#viewQrCodeModal').modal('toggle');
       }

        document.querySelector('#btn-update-activity').addEventListener('click', updateActivity);

        async function updateActivity() {
          let editActivityId        = document.querySelector('#editActivityId');
          let editActivityName        = document.querySelector('#editActivityName');
          let editActivityDescription = document.querySelector('#editActivityDescription');

          app.service('activities').update(editActivityId.value, {
              name         : editActivityName.value,
              description  : editActivityDescription.value,
          });

          $('#btn-update-activity').notify(`${editActivityName.value} successfully update.`, 'success', { position:'left' });
       }


       function editActivityModal(e) {
          let activity = JSON.parse(e.getAttribute('data-src'));
          $('#editActivityId').val(activity.id);
          $('#editActivityName').val(activity.name);
          $('#editActivityDescription').val(activity.description);
          $('#editActivityModalTitle').html(`Edit ${activity.name}`);
          $('#editActivityModal').modal('toggle');
       }

      
  </script>

@endpush
@endsection
