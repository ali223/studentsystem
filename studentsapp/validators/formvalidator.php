<?php

namespace StudentsApp\Validators;

class FormValidator 
{
	private $validationErrors = [];

	public function validateRequired($fieldName, $fieldValue) 
	{
		if(empty($fieldValue)) {
			$this->validationErrors[] = "The {$fieldName} must be filled in";
		}
	}

	public function validateEmail($fieldName, $fieldValue) 
	{
		if(!filter_var($fieldValue, FILTER_VALIDATE_EMAIL)) {
			$this->validationErrors[] = "The {$fieldName} must have an email description in proper format. For example: john@example.com";
		}
	}

	public function validateMaxLength($fieldName, $fieldValue, $length = 255) 
	{
		if(strlen($fieldValue) > $length) {
			$this->validationErrors[] = "The {$fieldName} must not contain more than {$length} characters";
		}
	}



	public function getValidationErrors() 
	{
		return $this->validationErrors;
	}
}