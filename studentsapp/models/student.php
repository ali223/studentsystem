<?php 
namespace StudentsApp\Models;

class Student 
{
     private $id;
     private $name;
     private $email;
     private $courses = [];

    public function setId($id) 
    {
         $this->id = $id;
    }

    public function getId() 
    {
        return $this->id;
    }

    public function setName($name) 
    {
         $this->name = $name;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function setEmail($email) 
    {
         $this->email = $email;
    }

    public function getEmail() 
    {
        return $this->email;
    }

    public function setCourses(array $courses) 
    {
         $this->courses = $courses;
    }

    public function getCourses() 
    {
        return $this->courses;
    }

}
	

		