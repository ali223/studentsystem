
<div class="container">	
    <div class="row">  
    	<div class="col-md-10 col-md-offset-1">

    		<?php if(isset($message)) : ?>
    			<div class="alert alert-success text-center" role="alert"> 
    				<strong><?= $message ?></strong>
    			</div>
    		<?php endif ?>

    		<div class="page-header text-center">
  				<h1>Courses</h1>
			</div>
    	</div>
    </div>
    <div class="row">  
        <div class="col-md-10 col-md-offset-1">        	        
		    <table class="table">
		    	<thead>
		    		<tr>
		    			<th>Course Title</th>
		    			<th>Course Description</th>
		    			<th>Students</th>
		    			<th></th>
		    		</tr>
		    	</thead>

		       <?php   foreach($coursesList as $course):   ?>
		            <tr> 
		                    <td> <?= $course->getTitle() ?> </td>
		                    <td> <?= $course->getDescription() ?> </td>
		                    <td> <em><?= count($course->getStudents()) ?> 
		                    	  <?= count($course->getStudents()) == 1 ? 'Student' : 'Students'?> 
		                    	 </em>
		                    </td>
		                    <td> <a href="viewcoursestudents?id=<?= $course->getId() ?>" class="btn btn-default btn-sm">View Students</a></td>
		            </tr>
		       <?php endforeach ?>
		    </table>
	   </div>
	</div>
</div>
