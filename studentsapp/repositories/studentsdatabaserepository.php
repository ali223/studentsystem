<?php 
namespace StudentsApp\Repositories;

use PDO;
use PDOException;
use StudentsApp\Models\Student;
use StudentsApp\Models\Course;
use StudentsApp\Utilities\RedirectTrait;

class StudentsDatabaseRepository implements StudentsRepositoryInterface
{
    use RedirectTrait;

    protected $databaseConnection;

    public function __construct(ConnectionInterface $databaseConnection)
    {
        $this->databaseConnection = $databaseConnection;
    }

    public function getAll() 
    {

        try {
              $connection = $this->databaseConnection->getConnection();
              $statement = $connection->prepare("select id, name, email from students");
              $statement->execute();
             
              $studentsList = $statement->fetchAll(PDO::FETCH_CLASS, Student::class);

              return $studentsList;
  
        }catch(PDOException $pdoException) {
              error_log("error occurred " . $pdoException->getMessage());
              $this->RedirectTo('errortechnical');
              exit;
        }
    }  

    public function getById($id)
    {
        try {
            $connection = $this->databaseConnection->getConnection();
            $statement = $connection->prepare("select id, name, email from students where id = :pid");

            $statement->bindValue(":pid", $id);

            $statement->execute();
           
            $statement->setFetchMode(PDO::FETCH_CLASS, Student::class);

            $student = $statement->fetch();

            if(empty($student)) {
                return false;
            }

            $statement = $connection->prepare("select courses.id, courses.title from courses, students_courses where courses.id = students_courses.course_id and student_id = :pstudent_id");

            $statement->bindValue(":pstudent_id", $student->getId());

            $statement->execute();

            $student->setCourses($statement->fetchAll(PDO::FETCH_CLASS, Course::class));

            return $student;
        
        }catch(PDOException $pdoException) {
            error_log("error occurred " . $pdoException->getMessage());
            $this->RedirectTo('errortechnical');
            exit;
        }


    }


    public function save(Student $student)
    {

        try{
            $connection = $this->databaseConnection->getConnection();         
            $statement = $connection->prepare(
                                  "insert into students"
                                . "(name, email)"
                                . "values (:pname, :pemail)");
         
            $statement->bindValue(":pname", $student->getName());
            $statement->bindValue(":pemail", $student->getEmail());
         
            $result= $statement->execute();

            $student->setId($connection->lastInsertId());

            $statement = $connection->prepare(
                                              "insert into students_courses"
                                            . "(student_id, course_id)"
                                            .  " values " 
                                            .  "(:pstudent_id, :pcourse_id)"
                                            ); 

            $courseIds = $student->getCourses();

            foreach($courseIds as $courseId) {
                $statement->bindValue(':pstudent_id', $student->getId());
                $statement->bindValue(':pcourse_id', $courseId);
                $result = $statement->execute();
            }

            return $result;
            
       }catch(PDOException $pdoException){
            error_log("error occurred " . $pdoException->getMessage());
            $this->RedirectTo('errortechnical');
            exit;
       } 
         
     }
}