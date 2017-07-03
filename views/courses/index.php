
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
		    <table class="table table-striped table-hover">
		    	<thead>
		    		<tr>
		    			<th width="20%">Course Title</th>
		    			<th width="60%">Course Description</th>
		    			<th width="10%">Students</th>
		    			<th width="10%"></th>
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
		                    <td> <a href="viewcoursestudents?id=<?= $course->getId() ?>" class="btn btn-primary btn-sm">View Students</a></td>
		            </tr>
		       <?php endforeach ?>
		    </table>
	   </div>
	</div>
</div>
