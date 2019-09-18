<div class="text-center">
	<a href="{{ route('instructor.edit', [$instructor]) }}" class="btn btn-success btn-sm text-center mr-3"><i class="fa fa-edit"></i></a>
	<a style="cursor:pointer;" onclick="inActiveInstructor('{{$instructor->id}}')" class="btn btn-danger btn-sm btn-white text-center text-white"><i class="fa fa-trash" ></i></a>
</div>


