<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Crete+Round|Exo" rel="stylesheet">
<title>Logcall</title>
<script>
	// Logcall Form Validation //
function validateForm() {
  var callerName = document.forms["frmLogCall"]["callerName"].value;
  var phoneNumber = document.forms["frmLogCall"]["phoneNumber"].value;
  var incidentLocation = document.forms["frmLogCall"]["incidentLocation"].value;
  var incidentDesc = document.forms["frmLogCall"]["incidentDesc"].value;
	  if (callerName == "") {
		alert("Please enter a name!");
		return false;
	  }
	  else if (phoneNumber == "") {
		 alert("Please enter a phone number!");
		 return false; 
	  }
	  else if (incidentLocation == "") {
			 alert("Please enter a location!");
		     return false;
			 }
	  else if (incidentDesc == "") {
		  alert("Please enter a description!");
		  return false;
	  }
}
	</script>
<style>
	legend
		{
			font-size: 25px;
			text-shadow: 1px 1px black;
		}
	.formTitle
		{
			font-family: 'Crete Round', serif;
		}
	</style>
<?php include "header.php";
	// Make sure user is logged in to access
if(isset($_SESSION)==false)
	session_start();
if(!isset($_SESSION['username'])) {
header('Location: signin.php');
}

if(isset($_POST['submit']))
	{


		$con = mysql_connect("localhost", "julianee", "password");
		if(!$con)
			{
				die('Cannot connect to database : ' . mysql_error());
			}

		mysql_select_db("22_julian_pessdb", $con);

		$sql = "INSERT INTO incident (callerName, phoneNumber, incidentType, incidentLocation, incidentDesc, incidentStatusid) VALUES('$_POST[callerName]','$_POST[phoneNumber]','$_POST[incidentType]','$_POST[incidentLocation]','$_POST[incidentDesc]','1')";

		if(!mysql_query($sql,$con))
			{
				die('Error: ' .mysql_error());
			}
			mysql_close($con);
	}
?>
</head>

<body>
<?php
// Dropdown bar for IncidentType, get data from database 
$con = mysql_connect("localhost","julianee","password");
if(!$con)
	{
	die('Cannot connect to database : ' . mysql_error());
	}

mysql_select_db("22_julian_pessdb", $con);	
$result = mysql_query("SELECT * FROM incidentType");
$incidentType;
while($row = mysql_fetch_array($result))
	{
	// incidenttypeid, incidenttypedesc
	$incidentType[$row['incidentTypeid']] = $row['incidentTypeDesc'];
	}
	mysql_close($con);

?>


<br>
<!-- Logcall Form -->
<form name="frmLogCall" onsubmit="return validateForm()" method="post" action="dispatch.php" >
  <fieldset>
    <legend align="center">Log Call</legend>
	<table align="center">
		<tr>
			<td class="formTitle" align="right">Caller's Name:</td> 
			<td><p><input type="text" name="callerName"></p></td>
		</tr>
		<tr>
			<td class="formTitle" align="right">Contact Number:</td> 
			<td><p><input type="text" name="phoneNumber"></p></td>
		</tr>
		<tr>
			<td class="formTitle" align="right">Location</td> 
			<td><p><input type="text" name="incidentLocation"></p></td>
		</tr>
		<tr>
			<td class="formTitle" align="right" class="td_label">Incident Type : </td>
			<td class="td_Date">
				<p>
					<select name="incidentType" id="incidentType">
						<?php foreach($incidentType as $key => $value){?>
							<option value="<?php echo $key ?>"><?php echo $value ?></option>
						<?php } ?>
					</select>
				</p>
			</td>
		</tr>
		<tr>
			<td class="formTitle" align="right">Description</td> 
			<td><p><textarea name="incidentDesc" row="5" col="50"></textarea></p></td>
		</tr>
	</table>
	  <div align="center">
	  	  <input type="reset" value="Reset" name="reset">
	  	  <input type="submit" value="Process Call" name="submit">
	  </div>
  </fieldset>
</form>
</body>
</html>