<?php
namespace StudentsApp\Controllers;

use StudentsApp\View;
use StudentsApp\Models\Course;
use StudentsApp\Repositories\CoursesRepositoryInterface;
use StudentsApp\Repositories\CoursesDatabaseRepository;
use StudentsApp\Validators\FormValidator;
use StudentsApp\Validators\FilterInputTrait;
use StudentsApp\Utilities\SessionUtility;
use StudentsApp\Utilities\RedirectTrait;

class CoursesController 
{
	use FilterInputTrait, RedirectTrait;

	protected $view;
	protected $coursesRepository;
	protected $sessionUtility;

	public function __construct(
		CoursesRepositoryInterface $coursesRepository, 
		SessionUtility $sessionUtility, 
		View $view
	) {
		$this->view = $view;
		$this->coursesRepository = $coursesRepository;
		$this->sessionUtility = $sessionUtility;
	}

	public function index() 
	{
        $coursesList = $this->coursesRepository->getAll();		

		$message = $this->sessionUtility->getFromSession("message");

		if(!empty($message)) {
			$this->view->setData("message", $message);
			$this->sessionUtility->removeFromSession("message");
		}

        $this->view->setContentFile("views/courses/index.php");
        $this->view->setData('coursesList', $coursesList);
        $this->view->renderView();
	}



	public function create() 
	{
		$this->view->setContentFile("views/courses/create.php");
		$this->view->renderView();
	}

	public function store() 
	{
		if($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->redirectTo('addcoursesform');
			return;
		}

		$course = new Course;
		$course->setTitle($this->filterInput(isset($_POST['title']) ? $_POST['title'] : ''));
		$course->setDescription($this->filterInput(isset($_POST['description']) ? $_POST['description'] : ''));

		$formValidator = new FormValidator;

		$formValidator->validateRequired('Course Name', $course->getTitle());
		$formValidator->validateRequired('Course Address', $course->getDescription());
		$formValidator->validateMaxLength('Course Name', $course->getTitle(), 255);
		$formValidator->validateMaxLength('Course Address', $course->getDescription(), 255);


		$errorsList = $formValidator->getValidationErrors();

		if($errorsList) {
	        $this->view->setContentFile("views/courses/create.php");
	        $this->view->setData('errorsList', $errorsList);
	        $this->view->setData('course', $course);
	        $this->view->renderView();

	        return;
		}

		$this->coursesRepository->save($course);
		
		$this->sessionUtility->storeInSession("message", "The course " . $course->getTitle() . " has been successfully saved in the database." );

		$this->redirectTo("viewcourses");

	}

	public function show()
	{
		if(!isset($_GET['id'])) {
			$this->redirectTo("error");
			return;
		}

		$courseId = $this->filterInput($_GET['id']);
		$course = $this->coursesRepository->getById($courseId);

		if(!$course) {
			$this->redirectTo("error");
			return;
		}

		$this->view->setContentFile("views/courses/show.php");
		$this->view->setData('course', $course);
		$this->view->renderView();
	}		
}