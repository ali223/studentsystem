<?php

namespace StudentsApp\Utilities;

Trait RedirectTrait 
{
	protected function redirectTo($location)
	{
		if(!empty($location)) {
			header("Location: {$location}");
		}
	}

}