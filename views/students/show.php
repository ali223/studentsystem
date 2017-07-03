
<div class="container">
    <div class="row">  
    	<div class="col-md-8 col-md-offset-2">
    		<div class="page-header text-center">
  				<h1>Student Details</h1>
			</div>
    	</div>
    </div>
    <div class="row">  
        <div class="col-md-8 col-md-offset-2">        	        
			    <table class="table">
			    		<tr>
			    			<th>Student Name</th>
			    			<td><?= $student->getName() ?></td>
			    		</tr>

			            <tr> 
			                <th>Student Email</th>
			                <td> <?= $student->getEmail() ?> </td>
			            </tr>

			            <tr> 
			                <th>Student Courses</th>
			                <td> 
			                    <?php if(count($student->getCourses()) > 0 ):  ?>
				                	<ul>
				                		<?php foreach($student->getCourses() as $course): ?>
				                			<li><?= $course->getTitle() ?></li>
				                		<?php endforeach ?>
					                </ul>

					            <?php else: ?>
					            	No Courses
			                    <?php endif ?>

			                </td>
			            </tr>


			    </table>
		    <hr>
		    <a href="viewstudents" class="btn btn-primary">Back to Students List</a>
	   </div>
	</div>
</div>
