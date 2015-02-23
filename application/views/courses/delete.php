<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Delete</title>
	<link rel="stylesheet" type="text/css" 
	      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body class="container">
	<h1 class="page-header">Delete Confirmation</h1>
	<p class="alert-danger">Are you sure you want to delete?</p>
	<div class="col-md-5 col-md-5-offset-1 well"> 
		<p>
		<?php foreach ($course_details as $course)
		 {
				echo "Course : ".$course['name']."<br>";
				echo "Description: ".$course['description'];
			?>
		</p>
		 <form action="remove_course" method="post">
			<input type="submit" value="Yes,I want to delete" class="btn btn-success">
			<input type="hidden" name="id" value="<?=$course['id']?>">
			<input type="hidden" name="action" value="confirm">
			<input type="submit" name="action" value="No" class="btn btn-danger">
		</form>
		</div>
<?php }?>
</body>
</html>