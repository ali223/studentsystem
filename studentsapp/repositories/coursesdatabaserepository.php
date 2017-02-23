<?php 
namespace StudentsApp\Repositories;

use PDO;
use PDOException;
use StudentsApp\Models\Student;
use StudentsApp\Models\Course;
use StudentsApp\Utilities\RedirectTrait;

class CoursesDatabaseRepository implements CoursesRepositoryInterface
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
            $statement = $connection->prepare("select id, title, description from courses");
            $statement->execute();

            $coursesList = $statement->fetchAll(PDO::FETCH_CLASS, Course::class);

            $statement = $connection->prepare("select student_id from students_courses where course_id = :pcourse_id");

            foreach($coursesList as $course) {

                $statement->bindValue(':pcourse_id', $course->getId());

                $statement->execute();

                $studentIds = $statement->fetchAll(PDO::FETCH_COLUMN);

                $course->setStudents($studentIds);

            }
            
            return $coursesList;
  
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
            $statement = $connection->prepare("select * from courses where id = :pid");

            $statement->bindValue(":pid", $id);

            $statement->execute();
           
            $statement->setFetchMode(PDO::FETCH_CLASS, Course::class);

            $course = $statement->fetch();

            if(empty($course)) {
                return false;
            }

            $statement = $connection->prepare("select students.id, students.name, students.email from students, students_courses where students.id = students_courses.student_id and course_id = :pcourse_id");

            $statement->bindValue(":pcourse_id", $course->getId());

            $statement->execute();

            $course->setStudents($statement->fetchAll(PDO::FETCH_CLASS, Student::class));

            return $course;
      
        }catch(PDOException $pdoException) {
            error_log("error occurred " . $pdoException->getMessage());
            $this->RedirectTo('errortechnical');
            exit;
        }


    }

    public function save(Course $course)
    {

        try{
            $connection = $this->databaseConnection->getConnection();         
            $statement = $connection->prepare(
                                  "insert into courses"
                                . "(title, description)"
                                . "values (:ptitle, :pdescription)");
         
            $statement->bindValue(":ptitle", $course->getTitle());
            $statement->bindValue(":pdescription", $course->getDescription());
         
            $result= $statement->execute();

            return $result;
       }catch(PDOException $pdoException){
            error_log("error occurred " . $pdoException->getMessage());
            $this->RedirectTo('errortechnical');
            exit;
       } 
         
     }        
}