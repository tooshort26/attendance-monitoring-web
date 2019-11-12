@extends('admin.layouts.dashboard-template')
@prepend('page-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
@endprepend
@section('title','Add new activity')
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
  </div>
  <div class="card-body">
        <form id="addActivityForm">
            <div class="row">
              <div class="col">
                <label>Name</label>
                <input type="text" id="activityName" required class="form-control" placeholder="Activity Name">
              </div>
              <div class="col">
                <label>Description</label>
                <input type="text" id="activityDescription"  required class="form-control" placeholder="Activity Description">
              </div>
              <div class="col">
                <label>Start Date & Time</label>
                  <div class="input-group date" id="startDateTimePicker" data-target-input="nearest">
                    <input type="text" id="activityStartDate" class="form-control datetimepicker-input" data-target="#startDateTimePicker"/>
                    <div class="input-group-append" data-target="#startDateTimePicker" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
              </div>
              <div class="col">
                <label>End Date & Time</label>
                  <div class="input-group date" id="endDateTimePicker" data-target-input="nearest">
                    <input type="text" id="activityEndDate" class="form-control datetimepicker-input" data-target="#endDateTimePicker"/>
                    <div class="input-group-append" data-target="#endDateTimePicker" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
              </div>
            {{--   <div class="col">
                <label>Start Date</label>
                <input type="text" id="activityStartDate"  required class="form-control">
              </div>
              <div class="col">
                <label>End Date</label>
                <input type="text" id="activityEndDate"  required class="form-control">
              </div> --}}
            </div>
            <div class="row">
              <div class="col">
                <div class="text-center" id="result"></div>
              </div>
            </div>
            <div class="float-right mt-3">
                 <button id="qrGenerate" type="button" class="btn btn-info">View QR Code</button>
                 <button type="submit" class="btn btn-primary" id="add-new-activity">Add new activity</button>
            </div>
          </form>
  </div>
</div>
<canvas id="canvas" width="300" height="300" style="display:none;"></canvas>
@push('page-scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="https://unpkg.com/@zxing/library@0.15.2/umd/index.min.js"></script>
<script>
       // Initialize Datetime picker
        $('#startDateTimePicker, #endDateTimePicker').datetimepicker({
            daysOfWeekDisabled: [0, 6]
        });

        // Socket.io setup
       const socket = io('localhost:3030');

       // Init feathers app
       const app = feathers();

       // Register socket.io to talk to server
       app.configure(feathers.socketio(socket));

       // Instructor form
       const addActivityForm     = document.querySelector('#addActivityForm');
       const activityName        = document.querySelector('#activityName');
       const activityDescription = document.querySelector('#activityDescription');
       const activityStartDate   = document.querySelector('#activityStartDate');
       const activityEndDate     = document.querySelector('#activityEndDate');
       const qrCodeContainer     = document.querySelector('#result');
       let qrCode = "";

       addActivityForm.addEventListener('submit', addActivity);
       document.querySelector('#qrGenerate').addEventListener('click', generateBarcode);

       function generateBarcode() {
          if (activityName.value.length >= 1) {
            const codeWriter = new ZXing.BrowserQRCodeSvgWriter();

            // Clear the QR Code Container
            qrCodeContainer.innerHTML = '';

            // Create QR Code base on the activity name
            codeWriter.writeToDom(qrCodeContainer, activityName.value, 300, 300);

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
                  document.querySelector('#result').innerHTML = '<img id="qr-code" src="'+png+'"/>';
                  DOMURL.revokeObjectURL(png);
              };
              img.src = url;
          } else {
            // Write the error message here...
          }
       }

       async function addActivity(e) {
           e.preventDefault();
          
           app.service('activities').create({
              name         : activityName.value,
              description  : activityDescription.value,
              start        : activityStartDate.value,
              end          : activityEndDate.value
          });

   

          toastr.success(`Successfully add ${activityName.value}`, 'Message', {timeOut: 6000});

          activityName.value = '';
          activityDescription.value = '';
          qrCodeContainer.innerHTML = '';
       }
</script>
@endpush
@endsection