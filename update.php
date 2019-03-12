<!doctype html>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Crete+Round|Exo" rel="stylesheet">
<meta charset="utf-8">
<title>Update</title>
<?php include "header.php";
if(isset($_SESSION)==false)
	session_start();
if(!isset($_SESSION['username'])) {
header('Location: signin.php');
}
	?>
<script>
function validatePatrolCar() {
  var patrolcarid = document.forms["form1"]["patrolcarid"].value;
	  if (patrolcarid == "") 
		  {
			alert("Please enter a Patrol Car ID!");
			return false;
		  }
}
	</script>
<style>
	legend
		{
			font-family: 'Patrick Hand', cursive;
			font-size: 25px;
			text-shadow: 1px 1px black;
		}
	.formTitle
		{
			font-family: 'Crete Round', serif;
		
	</style>
</head>
<body>
	<?php 
	if(!isset($_POST["btnSearch"])){
	$con = mysql_connect("localhost","julianee","password");
	
	if(!$con)
	{
	die('Cannot connect to database : ' . mysql_error());
	}

mysql_select_db("22_julian_pessdb", $con);	
$result = mysql_query("SELECT * FROM patrolcar");
$patrolcar;
while($row = mysql_fetch_array($result))
	{
		$patrolcar[$row['patrolcarid']] = $row['patrolcarid'];
	}
	mysql_close($con);

	?>
	<br>
	<form name="form1" onsubmit="return validatePatrolCar()" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?> ">
		<fieldset>
			<legend align="center">Update Patrol Car</legend>
			<br>
				<table width="70%" border="0" align="center" cellpadding="4" cellspacing="4">
					<tr>
						<td align="right" width="25%" class="td_label formTitle">Patrol Car ID :</td>
						<td align="right" width="25%" class="td_Data"><select name="patrolcarid" id="patrolcarid">
						<?php foreach($patrolcar as $key => $value){?>
							<option value="<?php echo $key ?>"><?php echo $value ?></option>
							<?php } ?>
					</select></td>
						<td align="center" class="td_Data"><input type="submit" name="btnSearch" id="btnSearch" value="Search"></td>
					</tr>
				</table>
			<br>
		</fieldset>
	</form>
		  
	<?php
	} 
		else {
			$con = mysql_connect("localhost", "julianee", "password");
			if(!$con)
				{
					die('Cannot connect to database : ' . mysql_error());
				}

	mysql_select_db("22_julian_pessdb", $con);
	$sql= "SELECT * FROM patrolcar WHERE patrolcarid='".$_POST['patrolcarid']."'";
		
	$result = mysql_query($sql,$con);
		
	$patrolcarid;
		
	$patrolCarStatusid;
		while($row = mysql_fetch_array($result))
			{
				$patrolcarid = $row['patrolcarid'];
				$patrolCarStatusid = $row['patrolcarStatusid'];
			}
		
	$sql = "SELECT * FROM patrolcar_status";
	$result = mysql_query($sql, $con);
	
	$patrolCarStatusMaster;
		
		while($row = mysql_fetch_array($result))
			{
				$patrolCarStatusMaster[$row['statusId']] = $row['statusDesc'];
			}
	mysql_close($con);
	?> 
	
<form name="form2" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
<fieldset>
	<legend>Update Patrol Car</legend>
		<table width="80%" border="0" align="center" cellpadding="4" cellspacing="4">
			<tr>
				<td width="25%" class="td_label">Patrol Car ID :</td>
				<td width="25%" class="td_Data"><?php echo $_POST["patrolcarid"]?><input type="hidden" name="patrolcarid" id="patrolcarid" value="<?php echo $_POST["patrolcarid"]?>">
				</td>
			</tr>
			<tr>
				<td class="td_label">Status :</td>
				<td class="td_Data">
					<select name="patrolCarStatus" id="$patrolCarStatus">
						<?php foreach($patrolCarStatusMaster as $key => $value){ ?>
							<option value="<?php echo $key ?>"
								<?php if ($key==$patrolCarStatusid) {?> selected="selected" <?php }?>>
								<?php echo $value ?>
							</option>	
						<?php } ?>
					</select>
				</td>
			</tr>			
		</table>
<br/>	
	<table width="80%" border="0" align="center" cellpadding="4" cellspacing="4">
		<tr>
			<td width="46%" class="td_label"><input type="reset" name="btnCancel" id="btnCancel" value="Reset"></td>
			<td width="54%" class="td_Data">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="btnUpdate" id="btnUpdate" value="Update"></td>
		</tr>
	</table>
</fieldset>
</form>
<?php }?>
<?php 
	if(isset($_POST["btnUpdate"])){
		$con = mysql_connect("localhost", "julianee", "password");
		
		if(!$con)
			{
				die('Cannot connect to database : '. mysql_error());
			}
		
		mysql_select_db("22_julian_pessdb", $con);
		
		$sql="UPDATE patrolcar SET patrolcarStatusid='".$_POST["patrolCarStatus"]."' WHERE patrolcarid='".$_POST['patrolcarid']."' ";
		
		if(!mysql_query($sql,$con))
			{
				die('Error4: ' .mysql_error());
			}
		
		if($_POST["patrolCarStatus"]=='4')
			{
		
				$sql="UPDATE dispatch SET timeArrived=NOW() WHERE timeArrived is NULL AND patrolcarid='".$_POST["patrolcarid"]."' ";

				if(!mysql_query($sql,$con))
					{
						die('Error4:' .mysql_error());
					}
			
			} 
		else if($_POST["patrolCarStatus"]=='3')
			{
				$sql = "SELECT incidentid FROM dispatch WHERE timeCompleted IS NULL AND patrolcari='".$_POST["patrolcarid"]."'";

				$result = mysql_query($sql,$con);

				$incidentid;

				while($row = mysql_fetch_array($result))
					{
						$incidentid = $row['incidentid'];
					}

				$sql="UPDATE dispatch SET timeCompleted=NOW() WHERE timeCompleted is NULL AND patrolcarid='".$_POST["patrolcarid"]."'";

				if(!mysql_query($sql,$con))
					{
						die('Error4:' .mysql_error());
					}

				$sql = "UPDATE incident SET incidentStatusid='3' WHERE incidentid='$incidentid' AND incidentid NOT IN(SELECT incidentid FROM dispatch WHERE timeCompleted IS NULL)";

				if(!mysql_query($sql, $con))
					{
						die('Error5:' .mysql_error());

					}
		}
mysql_close($con);
	?>
<script type="text/javascript">window.location="./logcall.php";</script>
<?php } ?>
</body>
</html>