<?php
namespace StudentsApp;

use Exception;
use StudentsApp\Controllers\StudentsController;
use StudentsApp\Controllers\CoursesController;
use StudentsApp\Controllers\PagesController;
use StudentsApp\Repositories\StudentsDatabaseRepository;
use StudentsApp\Repositories\CoursesDatabaseRepository;
use StudentsApp\Repositories\DatabaseConnection;
use StudentsApp\Utilities\SessionUtility;
use StudentsApp\View;

require_once 'configdatabase.php';

class Route
{
	private $routes = [];

	public function add($uri, $controllerName ) 
	{
		$this->routes[$uri] = $controllerName;
	}

	public function direct($uri)
	{	

		if(array_key_exists($uri, $this->routes)) {

			$uri = explode('@', $this->routes[$uri]);
			$controller = $uri[0];
			$action = $uri[1];

			return $this->callAction($controller, $action);
		} 
		
		return $this->callAction("PagesController", "showError");
	}

	protected function callAction($controller, $action) 
	{

		$controller = $this->makeController($controller);

		if(! method_exists($controller, $action)) {
			$controller = $this->makeController('PagesController');
			$action = 'showError';
		}

		return $controller->$action();
	}

	protected function makeController($controller)
	{
		$view = new View;

		switch($controller) {
	      case 'PagesController':
	          $controller = new PagesController($view);
	          break;

	      case 'StudentsController':
	          $databaseConnection = new DatabaseConnection(DB_DSN, DB_USER, DB_PASSWORD);	          
		      $studentsDatabase = new StudentsDatabaseRepository($databaseConnection);
		      $coursesDatabase = new CoursesDatabaseRepository($databaseConnection);
	      	  $sessionUtility = new SessionUtility;		      
	          $controller = new StudentsController($studentsDatabase, $coursesDatabase, $sessionUtility, $view);
	          break;

	       case 'CoursesController':
	       	  $databaseConnection = new DatabaseConnection(DB_DSN, DB_USER, DB_PASSWORD);
	      	  $coursesDatabase = new CoursesDatabaseRepository($databaseConnection);
	      	  $sessionUtility = new SessionUtility;
	          $controller = new CoursesController($coursesDatabase, $sessionUtility, $view);
	      	  break;
	     }	
	     return $controller;
	}
	
}