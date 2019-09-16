<?php 
namespace App\Contracts;

use App\Instructor;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\StudentImageUpload;

interface InstructorRepositoryContract
{
	public function __construct(Instructor $instructor, StudentImageUpload $uploader);
	public function get() : Collection;
	public function store(array $items = []) : Instructor;
	public function find(int $id) : Instructor;
	public function update(array $items = []) : bool;
}
