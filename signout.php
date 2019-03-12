<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign Out</title>
<?php include "header.php"
	?>
</head>

<body>
	<?php 
		session_start();
		session_destroy();
		header("location: signin.php");
	?>
</body>
</html>
