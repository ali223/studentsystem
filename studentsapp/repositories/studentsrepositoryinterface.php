<?php
namespace StudentsApp\Repositories;

use StudentsApp\Models\Student;

interface StudentsRepositoryInterface
{
	public function getAll();

	public function getById($id);

	public function save(Student $student);
}

