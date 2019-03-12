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
		// Create and destroy session
		session_start();
		session_destroy();
		// Bring user back to signin page afrer logged out
		header("location: signin.php");
	?>
</body>
</html>
