<?php 
namespace StudentsApp\Models;

class Course 
{
    private $id;
    private $title;
    private $description;
    private $students = [];

    public function setId($id) 
    {
         $this->id = $id;
    }

    public function getId() 
    {
        return $this->id;
    }

    public function setTitle($title) 
    {
         $this->title = $title;
    }

    public function getTitle() 
    {
        return $this->title;
    }

    public function setDescription($description) 
    {
         $this->description = $description;
    }

    public function getDescription() 
    {
        return $this->description;
    }

    public function setStudents(array $students) 
    {
         $this->students = $students;
    }

    public function getStudents() 
    {
        return $this->students;
    }

}
	

		