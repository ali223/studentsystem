<?php

namespace StudentsApp\Validators;

use StudentsApp\Models\Student;


class StudentValidator 
{
	protected $formValidator;
	

	public function __construct(FormValidator $formValidator)
	{
		$this->formValidator = $formValidator;
	}

	public function validate(Student $student)
	{

		$this->formValidator->validateRequired('Student Name', 
												$student->getName());

		$this->formValidator->validateRequired('Student Email', 
												$student->getEmail());

		$this->formValidator->validateEmail('Student Email', 
											$student->getEmail());		

		$this->formValidator->validateRequired('Student Courses', 
												$student->getCourses());

		$this->formValidator->validateMaxLength('Student Name', 
											$student->getName(), 255);

		$this->formValidator->validateMaxLength('Student Email', 
											$student->getEmail(), 255);

		return $this->formValidator->getValidationErrors();
	}

}