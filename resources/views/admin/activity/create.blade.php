@extends('admin.layouts.dashboard-template')
@prepend('page-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.css" integrity="sha256-HF310xdxXK7TJqGFC69nzYYGbuxJO6MErjHdlhD2ZBU=" crossorigin="anonymous" />
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
<script src="https://unpkg.com/@zxing/library@0.15.2/umd/index.min.js"></script>
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

       // Instructor form
       const addActivityForm     = document.querySelector('#addActivityForm');
       const activityName        = document.querySelector('#activityName');
       const activityDescription = document.querySelector('#activityDescription');
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
          });

          activityName.value = '';
          activityDescription.value = '';
          qrCodeContainer.innerHTML = '';

          $('#add-new-activity').notify('Succesfully add.', 'success', { position:'left' });
       }
</script>
@endpush
@endsection