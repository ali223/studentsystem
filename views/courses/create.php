<div class="container">
    <div class="row">  
    	<div class="col-md-8 col-md-offset-2">
    		<?php if(isset($errorsList)) : ?>
    			<div class="alert alert-danger" role="alert"> 
    			   <ul>
	    			   <?php foreach($errorsList as $error): ?>
	    			   		<li><?= $error ?></li>
	    			   <?php endforeach ?>  	
	    		   </ul>
    			 </div>
    		<?php
    			  endif; 
    		?>

    		<div class="page-header text-center">
  				<h1>Add Courses </h1>
			</div>
    	</div>
    </div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<form method = "POST" action = "savecourse">
				<div class="form-group">
					<label for="title">Course Title:</label>
					<input type="text" name="title" class="form-control"
					value = "<?= isset($course) ? $course->getTitle() : '' ?>" 
					maxlength="255" required> 					
				</div>
				<div class="form-group">
					<label for="description">Course Description:</label>
					<input type="text" name="description" class="form-control"
					value = "<?= isset($course) ? $course->getDescription() : '' ?>" 
					maxlength="255" required> 	
				</div>				
				<hr>
				<div class="form-group">
					<input type="submit" value="Add New Course" class="btn btn-success">	
				</div>				

			</form>
		</div>
	</div>
</div>