<?php
namespace StudentsApp\Controllers;

use StudentsApp\Repositories\StudentsRepositoryInterface;
use StudentsApp\Repositories\CoursesRepositoryInterface;
use StudentsApp\Repositories\CoursesDatabaseRepository;
use StudentsApp\Repositories\StudentsDatabaseRepository;
use StudentsApp\Models\Student;
use StudentsApp\View;
use StudentsApp\Validators\FilterInputTrait;
use StudentsApp\Validators\FormValidator;
use StudentsApp\Utilities\SessionUtility;
use StudentsApp\Utilities\RedirectTrait;

class StudentsController 
{
	use FilterInputTrait, RedirectTrait;

	protected $view;
	protected $studentsRepository;
	protected $coursesRepository;
	protected $sessionUtility;

	public function __construct(
		StudentsRepositoryInterface $studentsRepository, 
		CoursesRepositoryInterface $coursesRepository, 
		SessionUtility $sessionUtility, 
		View $view
	) {
		$this->studentsRepository = $studentsRepository;
		$this->coursesRepository = $coursesRepository;
		$this->sessionUtility = $sessionUtility;
		$this->view = $view;
	}

	public function index() 
	{
        $studentsList = $this->studentsRepository->getAll();		

		$message = $this->sessionUtility->getFromSession("message");

		if(!empty($message)) {
			$this->view->setData("message", $message);
			$this->sessionUtility->removeFromSession("message");
		}

        $this->view->setContentFile("views/students/index.php");
        $this->view->setData('studentsList', $studentsList);
        $this->view->renderView();
	}

	public function show()
	{
		if(!isset($_GET['id'])) {
			$this->redirectTo("error");
			return;
		}

		$studentId = $this->filterInput($_GET['id']);
		$student = $this->studentsRepository->getById($studentId);

		if(!$student) {
			$this->redirectTo("error");
			return;
		}

		$this->view->setContentFile("views/students/show.php");
		$this->view->setData('student', $student);
		$this->view->renderView();
	}	


	public function create()
	{
		$coursesList = $this->coursesRepository->getAll();
        $this->view->setContentFile("views/students/create.php");
        $this->view->setData('coursesList', $coursesList);                
        $this->view->renderView();		
	}

	public function store()
	{
		if($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->redirectTo('addstudentsform');
			return;
		}

		$student = new Student();

		$student->setName($this->filterInput(isset($_POST['name']) ? $_POST['name'] : ''));
		$student->setEmail($this->filterInput(isset($_POST['email']) ? $_POST['email'] : ''));
		$student->setCourses($this->filterInput(isset($_POST['courses']) ? $_POST['courses'] : []));

		$formValidator = new FormValidator;		

		$formValidator->validateRequired('Student Name', $student->getName());
		$formValidator->validateRequired('Student Email', $student->getEmail());
		$formValidator->validateEmail('Student Email', $student->getEmail());		
		$formValidator->validateRequired('Student Courses', $student->getCourses());

		$formValidator->validateMaxLength('Student Name', $student->getName(), 255);
		$formValidator->validateMaxLength('Student Email', $student->getEmail(), 255);


		$errorsList = $formValidator->getValidationErrors();

		if($errorsList) {
	        $this->view->setContentFile("views/students/create.php");
	        $this->view->setData('errorsList', $errorsList);

       		$coursesList = $this->coursesRepository->getAll();
	    	$this->view->setData('coursesList', $coursesList);                

	        $this->view->setData('student', $student);
	        $this->view->renderView();

	        return;
		}


		$this->studentsRepository->save($student);

		$this->sessionUtility->storeInSession("message", "The student " . $student->getName() . " has been successfully saved in the database." );

		$this->redirectTo("viewstudents");


	}
}