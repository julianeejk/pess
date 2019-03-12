<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="https://fonts.googleapis.com/css?family=Crete+Round|Exo" rel="stylesheet">
<title>Sign In</title>
<script>
// Make sure fields are not empty 
function validateLogin() {
  var user = document.forms["signin"]["username"].value;
  var pass = document.forms["signin"]["password"].value;
	  if (user == "") 
		  {
			alert("Please enter a username!");
			return false;
		  }
	  else if(pass == "")
		  {
			  alert("Please enter a password!");
			  return false;
		  }
}
	</script>
<style>
	.center{
		align: "center";
	}
	.formTitle
		{
			font-family: 'Crete Round', serif;
		}
	legend
		{
			color: red;
			font-family: 'Patrick Hand', cursive;
			font-size: 40px;
			text-shadow: 1px 1px black;
		}
	</style>	
<?php include "header.php";
	// Check if session exists
	if(isset($_SESSION) == false)
		{
			session_start();
		}
	// If correct session already exists
	if(isset($_SESSION['username']))
		{
			header("location: signin2.php");
		}
	
	if(isset($_POST['SignInsubmit']))
	{
		$con = mysql_connect("localhost", "julianee", "password");
		if(!$con)
			{
				die('Cannot connect to database : ' . mysql_error());
			}

		mysql_select_db("22_julian_pessdb", $con);
		
		$name = $_POST['username'];
		$pass = $_POST['password'];

		$sql = "SELECT * FROM users where loginUsername = '$name' && loginPassword = '$pass'";
		
		$result = mysql_query($sql,$con);
		
		$num = mysql_num_rows($result);
	    // If user found in database, grant access to all pages
		if($num == 1)
			{
				$_SESSION['username'] = $_POST['username'];
				header("location: logcall.php");
			}
		// If user not found, bring to signinerror.php
		else
			{
				header("location: signinerror.php");
			}
			mysql_close($con);
	}
?>
</head>
<body>
<br>
<fieldset>
	<legend align="center">Please sign in to continue!</legend>
		<br>
		<div align="center">
			<form name="signin" onsubmit="return validateLogin()" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
				<table>
					<tr>
						<td class="formTitle" align="right">Username: </td> 
						<td><p><input type="text" name="username"></p></td>
					</tr>
					<tr>
						<td class="formTitle" align="right">Password: </td> 
						<td><p><input type="password" name="password"></p></td>
					</tr>
				</table>
				<br>
					  	<input type="submit" value="Submit" name="SignInsubmit">
			</form>
		</div>
</fieldset>
</body>
</html>
