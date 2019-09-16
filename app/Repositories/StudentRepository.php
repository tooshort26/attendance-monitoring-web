<?php 
namespace App\Repositories;

use App\Student;
use Illuminate\Database\Eloquent\Collection;
use App\Contracts\StudentRepositoryContract;
use App\Repositories\StudentImageUpload;

class StudentRepository implements StudentRepositoryContract
{

	protected $model;
    protected $uploader;

    public function __construct(Student $student, StudentImageUpload $uploader)
    {
    	$this->model = $student;
        $this->uploader = $uploader;
    }

    public function get() : Collection
    {
        return $this->model->get();
    }

    public function store(array $items = []) : Student
    {
    	return $this->model->create($items);
    }

    public function find(int $id) : Student
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