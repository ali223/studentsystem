<?php
namespace StudentsApp\Controllers;

use StudentsApp\View;

class PagesController 
{

	protected $view;

	public function __construct(View $view)
	{
		$this->view = $view;
	}

	public function showError() 
	{
		$this->view->setContentFile('views/pages/showerror.php');
		$this->view->renderView();
	}

	public function showErrorTechnical() 
	{
		$this->view->setContentFile('views/pages/showerrortechnical.php');
		$this->view->renderView();
	}

	
}