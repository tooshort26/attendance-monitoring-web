@extends('admin.layouts.dashboard-template')
@section('title','Add subject for student')
@section('content')
<div class="row mb-2">
	<div class="col-lg-12">
		@if(\Session::has('success'))
			@include('templates.success')
		@else
			@include('templates.error')
		@endif
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4 rounded-0">
			<div class="card-header py-3 rounded-0">
				<h6 class="m-0 font-weight-bold text-primary">Add subject for {{ ucwords($student->name) }}</h6>
			</div>
			<div class="card-body" >
				<form action="{{ route('student.subject.store', [$student]) }}" method="POST">
					@csrf
					<div class="row" id="subjectFields">
					@if( !empty(old('subjects.name')) && !empty(old('subjects.description')) && !empty(old('subjects.semester')))
					@foreach(old('subjects.name') as $index => $name)
					<div class="col-lg-3 form-group name-index-{{$index}}">
						<input type="text" class="form-control" name="subjects[name][{{ $index }}]" id="subjectName{{$index}}" placeholder="Enter Subject name..." value="{{ old('subjects.name.' . $index)}}">
					</div>
					<div class="col-lg-3 form-group description-index-{{$index}}">
						<input type="text" class="form-control" name="subjects[description][{{$index}}]" id="subjectDescription{{$index}}" placeholder="Enter Subject description..." value="{{ old('subjects.description.' . $index)}}">
					</div>
					<div class="col-lg-3 form-group level-index-{{$index}}">
						<input type="text" class="form-control" name="subjects[level][{{$index}}]" id="subjectLevel{{$index}}" placeholder="Enter Subject level..." value="{{ old('subjects.level.' . $index)}}">
					</div>
					<div class="col-lg-2 form-group semester-index-{{$index}}">
						<input type="text" class="form-control" name="subjects[semester][{{$index}}]" id="subjectSemester{{$index}}" placeholder="Enter Subject semester..." value="{{ old('subjects.semester.' . $index)}}">
					</div>
					<div class="col-lg-1 remove-field-{{$index}}">
						<button type="button" class="btn btn-sm btn-danger font-weight-bold text-white mt-1" data-index="{{ $index }}" onclick="removeField(this)">X</button>
					</div>
					@endforeach
					
					@endif
				</div>
				<div class="float-right">
					<button id="addNewSubjectField" type="button" class="btn btn-circle btn-info font-weight-bold" title="Add subject field"><i class="fa fa-plus-circle"></i></button>
				</div>
				<div class="clearfix"></div>
				<hr>
					<div class="float-right">
						<input type="submit" class="btn btn-primary mt-1 font-weight-bold" value="Add Subjects">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@push('page-scripts')
<script>
	const cardSubjectsBody = document.querySelector('#subjectFields');
	let index = 0;

	document.addEventListener('DOMContentLoaded', (e) => {
		
		document.querySelector('#addNewSubjectField').addEventListener('click' , (e) => {
		index++;
		let subjectNameField = document.createElement('input');
		let subjectDescriptionField = document.createElement('input');
		let subjectYearField = document.createElement('input');
		let subjectSemesterField = document.createElement('input');


		subjectNameField.setAttribute('type', 'text');
		subjectNameField.setAttribute('class', `form-control`);
		subjectNameField.setAttribute('name', `subjects[name][]`);
		subjectNameField.setAttribute('placeholder', 'Enter Subject name...');
		subjectDescriptionField.setAttribute('type', 'text');
		subjectDescriptionField.setAttribute('class', `form-control`);
		subjectDescriptionField.setAttribute('name', `subjects[description][]`);
		subjectDescriptionField.setAttribute('placeholder', 'Enter Subject description...');
		subjectYearField.setAttribute('type', 'number');
		subjectYearField.setAttribute('class', `form-control`);
		subjectYearField.setAttribute('name', `subjects[level][]`);
		subjectYearField.setAttribute('placeholder', 'Enter Subject level...');
		subjectSemesterField.setAttribute('type', 'number');
		subjectSemesterField.setAttribute('class', `form-control`);
		subjectSemesterField.setAttribute('name', `subjects[semester][]`);
		subjectSemesterField.setAttribute('placeholder', 'Enter Subject semester...');

		let subjectNameFieldContainer = document.createElement('div');
		let subjectDescriptionFieldContainer = document.createElement('div');
		let subjectSemesterFieldContainer = document.createElement('div');
		let subjectLevelFieldContainer = document.createElement('div');
		let removeButtonContainer = document.createElement('div');

		subjectNameFieldContainer.setAttribute('class', `col-lg-3 form-group name-index-${index}`);
		subjectDescriptionFieldContainer.setAttribute('class', `col-lg-3 form-group description-index-${index}`);
		subjectLevelFieldContainer.setAttribute('class', `col-lg-3 form-group level-index-${index}`);
		subjectSemesterFieldContainer.setAttribute('class', `col-lg-2 form-group semester-index-${index}`);
		removeButtonContainer.setAttribute('class', `col-lg-1 remove-field-${index}`);

		cardSubjectsBody.appendChild(subjectNameFieldContainer);
		subjectNameFieldContainer.appendChild(subjectNameField);
		cardSubjectsBody.appendChild(subjectDescriptionFieldContainer);
		subjectDescriptionFieldContainer.appendChild(subjectDescriptionField);
		cardSubjectsBody.appendChild(subjectLevelFieldContainer);
		subjectLevelFieldContainer.appendChild(subjectYearField);
		cardSubjectsBody.appendChild(subjectSemesterFieldContainer);
		subjectSemesterFieldContainer.appendChild(subjectSemesterField);

		cardSubjectsBody.appendChild(removeButtonContainer);

		let removeButton = document.createElement('button');
			removeButton.appendChild(document.createTextNode('X'));
			removeButton.setAttribute('type', 'button');
			removeButton.setAttribute('class', `btn btn-sm btn-danger font-weight-bold text-white mt-1`);
			removeButton.setAttribute('data-index', index);
			removeButton.setAttribute('onclick', `removeField(this)`);
			removeButtonContainer.appendChild(removeButton);
		});
	});

	function removeField( button) {
		let index = button.getAttribute('data-index');
		let subjectNameField = document.querySelector(`.name-index-${index}`);
		let subjectDescriptionField = document.querySelector(`.description-index-${index}`);
		let subjectYearField = document.querySelector(`.level-index-${index}`);
		let subjectSemesterField = document.querySelector(`.semester-index-${index}`);
		let thisButton = document.querySelector(`.remove-field-${index}`);
		cardSubjectsBody.removeChild(subjectNameField);
		cardSubjectsBody.removeChild(subjectDescriptionField);
		cardSubjectsBody.removeChild(subjectYearField);
		cardSubjectsBody.removeChild(subjectSemesterField);
		cardSubjectsBody.removeChild(thisButton);
	}
</script>
@endpush
@endsection