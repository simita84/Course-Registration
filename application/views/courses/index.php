 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Courses</title>
	<link rel="stylesheet" type="text/css" 
	      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<style type="text/css">
		body
		{
			margin-top: 30px;
		} 
		.alert-success
		{
			padding: 10px;
		}
	</style>
</head>
<body class="container">
	<h1 class="page-header">Manage Courses</h1> 
	<div class="row"> 
		<div class="col-md-6">
		<?php
			 if ($this->session->flashdata('success_message') ) 
		 	 {?>
		 		<div class="alert-success">
		 			 <p><?php echo $this->session->flashdata('success_message');?></p>
		 		</div>
				
		<?php }
			else if ($this->session->flashdata('error_message') ) 
		  	{?>  
		  		<div class="alert-danger">
		  			<p><?php echo $this->session->flashdata('error_message'); ?></p>
		  		</div>
	 <?php }?>
	    </div> 
    </div>
    <div class="row"> 
		<div class="col-md-5">
			<form action="courses/add_course" method="post" class="well">
				<div class="form-group">
					<label>Course Name</label>
					<input type="text" name="course_name" class="form-control">
				</div>
				<div class="form-group">
					<label>Course Description</label>
					<textarea name="course_desc" class="form-control"></textarea>
				</div>
				<input type="submit" value="Add Course" class="btn btn-primary">
				<input type="hidden" name="form_action" value="add_course">
			</form>
		</div>
	</div>
	<div class="row"> 
		<h3>Course details</h3>
		<div>
			<table class="table table-striped table-bordered">
				 <thead>
				 	<th>	Name		</th>
				 	<th>	Description	</th>
				 	<th>	Created At	</th>
				 	<th>	Updated At 	</th>
				 	<th>	Action		</th>
				 </thead>
				 <tbody> 
				<?php foreach($courses as $course) 
				{ ?>
				<tr>
				  <td><?php echo $course['name'];?>			</td>
				  <td><?php echo $course['description'];?>	</td>
				  <?php 
				  		$created_time=$course['created_at'];
					    $updated_time=$course['updated_at'];
                        $created_at = new DateTime($created_time);
                        $updated_at = new DateTime($updated_time);
                        $time_zone = new DateTimeZone('America/Los_Angeles');
						$created_at->setTimezone($time_zone);
						$updated_at->setTimezone($time_zone);
					    ?>
				  <td><?php echo date_format($created_at,'M d 20y , g:i A T') ;?>  </td>
				  <td><?php echo date_format($updated_at,'M d 20y , g:i A T') ; ?>  </td>
				  <td> 
					  <form action="courses/delete_confirmation" method="post">
					  	<input type="hidden" name="action" value="remove_course">
					  	<input type="hidden" name="id" value="<?=$course['id']?>">
					  	<input type="submit" class="btn btn-danger" value="Remove">
					  </form>
				  </td>
				</tr>
			 <? }
				?>
				</tbody>
			</table>
		 </div>
	 </div>
</body>
</html>
 