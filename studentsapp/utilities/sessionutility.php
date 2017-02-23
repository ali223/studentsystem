<?php

namespace StudentsApp\Utilities;

class SessionUtility
{
	public function storeInSession($key, $value)
	{
		if(session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		$_SESSION[$key] = $value;
	}

	public function getFromSession($key)
	{
		if(session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
	}

	public function removeFromSession($key)
	{
		if(session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if(isset($_SESSION[$key])) {
			unset($_SESSION[$key]);
		}
	}	

}