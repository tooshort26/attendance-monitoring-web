<?php 
namespace App\Repositories;

use App\Student;
use Illuminate\Database\Eloquent\Collection;
use App\Contracts\StudentRepositoryContract;
use App\Repositories\StudentImageUpload;
use JD\Cloudder\Facades\Cloudder;

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
        if (request()->hasFile('profile')) {
            $image_name = request()->file('profile')->getRealPath();
            Cloudder::upload($image_name, null);
            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => 150, "height"=> 150]);
            $items['profile'] = $image_url;
        }
    	return $this->find($items['id'])->update($items);
    }
}