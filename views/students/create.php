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
  				<h1>Add Students </h1>
			</div>
    	</div>
    </div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<form method = "POST" action = "savestudent">
				<div class="form-group">
					<label for="name">Student Name:</label>
					<input type="text" name="name" class="form-control"
					value = "<?= isset($student) ? $student->getName() : '' ?>" maxlength="255" required> 
				</div>
				<div class="form-group">
					<label for="email">Student Email:</label>
					<input type="text" name="email" class="form-control"
					value = "<?= isset($student) ? $student->getEmail() : '' ?>" maxlength="255" required>
				</div>				
				<div class="form-group">
					<label for="name">Student Courses:</label>
					<select name="courses[]" multiple="multiple" class="form-control" required>			
					<?php foreach($coursesList as $course): ?>
						<option value = "<?= $course->getId() ?>"
						<?php if(isset($student)): ?>
						   <?= in_array($course->getId(), $student->getCourses()) ? 'selected' : ''   ?>
						 <?php endif ?>
						   >

						     <?= $course->getTitle() ?></option>
					<?php endforeach;?>
					</select>
					<br>
					<ul>
						<li>For windows: Hold down the control (ctrl) button to select multiple options</li>
						<li>For Mac: Hold down the command button to select multiple options
						</li>
					</ul>
				</div>	
				<hr>							
				<div class="form-group">
					<input type="submit" value="Add New Student" class="btn btn-success">					
				</div>				

			</form>
		</div>
	</div>
</div>