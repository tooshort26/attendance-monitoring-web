      let socketRun = io('localhost:3030');
      let appFeathers = feathers();
      appFeathers.configure(feathers.socketio(socketRun));



       async function init() {
          appFeathers.service('attendances').on('created', (attendance) => {
              toastr.success(`${attendance.firstname} ${attendance.lastname} attend ${attendance.name} - ${attendance.description} .`, 'Activity Attendance', {timeOut: 6000});
          });
       }
       init();