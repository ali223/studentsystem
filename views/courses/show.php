
<div class="container">
    <div class="row">  
    	<div class="col-md-8 col-md-offset-2">
    		<div class="page-header text-center">
  				<h1><?= $course->getTitle() ?> 
  					<small><?= count($course->getStudents()) ?> 
  							<?= count($course->getStudents()) == 1 ? 'Student' : 'Students' ?>
  					</small>
  				</h1>
			</div>
    	</div>
    </div>
    <div class="row">  
        <div class="col-md-8 col-md-offset-2">        	        
            <?php if(count($course->getStudents()) > 0) :  ?>
			    <table class="table">
			    	<thead>
			    		<tr>
			    			<th>Student Name</th>
			    			<th>Student Email</th>
			    		</tr>
			    	</thead>

			       <?php   foreach($course->getStudents() as $student):   ?>
			            <tr> 
			                    <td> <?= $student->getName() ?> </td>
			                    <td> <?= $student->getEmail() ?> </td>
			            </tr>
			       <?php endforeach ?>
			    </table>
			<?php else: ?>
				<div class="alert alert-warning text-center">
					<strong>No students found belonging to <?= $course->getTitle() ?></strong>
				</div>
			<?php endif ?>		
		    <hr>
		    <a href="viewcourses" class="btn btn-primary">Back to Courses List</a>
	   </div>
	</div>
</div>
