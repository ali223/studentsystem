
<div class="container">
    <div class="row">  
    	<div class="col-md-8 col-md-offset-2">
    		<?php if(isset($message)) : ?>
    			<div class="alert alert-success text-center" role="alert">
    				 <strong><?= $message ?></strong>
    			</div>
    		<?php endif ?>
    		<div class="page-header text-center">
  				<h1>Students</h1>
			</div>
    	</div>
    </div>
    <div class="row">  
        <div class="col-md-8 col-md-offset-2">        	        
		    <table class="table table-striped table-hover">
		    	<thead>
		    		<tr>
		    			<th>Student Name</th>
		    			<th>Student Email</th>
		    			<th></th>
		    		</tr>
		    	</thead>

		       <?php   foreach($studentsList as $student):   ?>
		            <tr> 
		                    <td> <?= $student->getName() ?> </td>
		                    <td> <?= $student->getEmail() ?> </td>
		                    <td><a href="viewstudentdetails?id=<?= $student->getId() ?>" class="btn btn-primary btn-sm">View Details</a></td>
		            </tr>
		       <?php endforeach ?>
		    </table>
	   </div>
	</div>
</div>
