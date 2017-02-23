<?php
namespace StudentsApp\Repositories;

use StudentsApp\Models\Course;

interface CoursesRepositoryInterface
{
	public function getAll();

	public function getById($id);

	public function save(Course $course);
}


