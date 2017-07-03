<?php

namespace StudentsApp\Utilities;

Trait PostDataTrait 
{
	protected function getPostVariable($postVariable)
	{
		if(! isset($_POST[$postVariable])) {
			return '';
		}


		return $_POST[$postVariable];
	}

	protected function getPostArray($postArray)
	{
		if(! isset($_POST[$postArray])) {
			return [];
		}


		return $_POST[$postArray];
	}


}