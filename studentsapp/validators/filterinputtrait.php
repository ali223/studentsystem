<?php

namespace StudentsApp\Validators;


trait FilterInputTrait 
{    
    protected function filterInput($data) 
    {
    	if(!is_array($data)) {
		    $data = trim($data);
	        $data = stripslashes($data);
	        $data = htmlspecialchars($data);
	        return $data;
    	}

    	foreach($data as &$value) {
    		$value = trim($value);
	        $value = stripslashes($value);
	        $value = htmlspecialchars($value);
    	}
    	return $data;
    }
}
    

