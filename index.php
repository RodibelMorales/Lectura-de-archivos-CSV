<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="font/css/font-awesome.css">
</head>
<body>
	<section class="container">
		<section class="row">
			<div class="col-md-6 col-md-offset-3">
				<form action="leercsv.php" method="POST" enctype="multipart/form-data">
				  <div class="form-group">
				    <label>Subir archivo</label>
				    <input type="file" name="info">
				  </div>
				  <button type="submit" class="btn btn-success col-md-12">
				  	<i class="fa fa-upload spaceico"></i>Upload
				  </button>
				</form>
			</div>
		</section>
	</section>



<script src="js/jquery-3.2.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>