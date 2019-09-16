<div class="card bg-success text-white shadow">
    <div class="card-body font-weight-bold">
    	{{ \Session::get('success') }} <div class="float-right"><a class="text-white" href="{{ route('student.subject.store', [\Session::get('student_id')])}}">Click this link for adding subjects</a></div>
    </div>
</div>
