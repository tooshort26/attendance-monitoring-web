<?php
namespace App\Repositories;

use App\Instructor;
use Illuminate\Database\Eloquent\Collection;
use App\Contracts\InstructorRepositoryContract;
use App\Repositories\StudentImageUpload;

class InstructorRepository implements InstructorRepositoryContract
{
	protected $model;
	protected $uploader;

	public function __construct(Instructor $instructor, StudentImageUpload $uploader)
	{
		$this->model = $instructor;
		$this->uploader = $uploader;
	}

	public function get() :Collection
	{
		return $this->model->get();
	}

	public function store(array $items = []) :Instructor
	{
		if ($this->uploader->hasFile('profile')) {
            $name = $items['profile']->getClientOriginalName();
            $this->uploader->upload($items['profile']);    
            $items['profile'] = $name;
        }
		return $this->model->create($items);
	}

	public function find(int $id) : Instructor
	{
		return $this->model->find($id);
	}

	public function update(array $items = []) : bool
	{
		if ($this->uploader->hasFile('profile')) {
            $name = $items['profile']->getClientOriginalName();
            $this->uploader->upload($items['profile']);    
            $items['profile'] = $name;
        }
		return $this->find($items['id'])->update($items);
	}
}