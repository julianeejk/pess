<?php 
// Make sure user submitted Logcall to access
	if(!isset($_POST['submit']) && !isset($_POST['btnCancel']))
		header("Location: logcall.php");
	?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dispatched</title>
<?php include "header.php";
	
	// Insert input to database
	if(isset($_POST["btnSubmit"]))
		{
			$con = mysql_connect("localhost", "julianee", "password");
	
    if(!$con)
		{
			die('Cannot connect to database : ' . mysql_error());
		}

	mysql_select_db("22_julian_pessdb", $con);
	
	$patrolcarDispatched = $_POST["chkPatrolcar"];
	
	$c = count($patrolcarDispatched); 
	
	$status;
	if ($c > 0){
		$status='2';
	}
	else {
		$status='1';
	}

	$sql = "INSERT INTO incident (callerName, phoneNumber, incidentType, incidentLocation, incidentDesc, incidentStatusid) VALUES('".$_POST['callerName']."','".$_POST['phoneNumber']."','".$_POST['incidentType']."','".$_POST['incidentLocation']."','".$_POST['incidentDesc']."','$status')";
		
	if(!mysql_query($sql,$con))
		{
			die('Error1:' .mysql_error());
		}
	
	$incidentId=mysql_insert_id($con);;
	
	for($i=0; $i < $c; $i++)
		{
			$sql = "UPDATE patrolcar SET patrolcarStatusid='1' WHERE patrolcarid='$patrolcarDispatched[$i]'";
			echo $sql;

			if(!mysql_query($sql,$con))
				{
					die('Error2:' .mysql_error());
				}

			$sql = "INSERT INTO dispatch(incidentid, patrolcarid, timeDispatched) VALUES ('$incidentId','$patrolcarDispatched[$i]',NOW())";

			if(!mysql_query($sql,$con))
				{
					die('Error3:' .mysql_error());
				}
		}

	mysql_close($con);
}
	?>
</head>
<body>
	<?php 
	$con = mysql_connect("localhost", "julianee", "password");
    if(!$con)
		{
			die('Cannot connect to database : ' . mysql_error());
		}

	mysql_select_db("22_julian_pessdb", $con);
	
	$sql = "SELECT patrolcarid, statusDesc FROM patrolcar JOIN patrolcar_status ON patrolcar.patrolcarStatusid=patrolcar_status.statusId WHERE patrolcar.patrolcarStatusid='2' OR patrolcar.patrolcarStatusid='3'";
	
	$result = mysql_query($sql, $con);
	
	$incidentArray;
	$count=0;
	while($row = mysql_fetch_array($result))
		{
			$patrolcarArray[$count]=$row;
			$count++;
		}
	if(!mysql_query($sql, $con))
		{
			die('Error: ' . mysql_error());
		}
	
	mysql_close($con);
	?>
<form name="dispatchForm" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
<table width="20%" border="0" align="center">
		<tr>
			<td>Caller Name:</td>
			<td>
				<?php echo $_POST['callerName']; ?>
				<input type="hidden" name="callerName" value="<?php echo $_POST['callerName']; ?>"
			</td>
		</tr>
		<tr>
			<td>Contact No:</td>
			<td>
				<?php echo $_POST['phoneNumber']; ?>
				<input type="hidden" name="phoneNumber" value="<?php echo $_POST['phoneNumber']; ?>"
			</td>
		</tr>
		<tr>
			<td>Location:</td>
			<td>
				<?php echo $_POST['incidentLocation']; ?>
				<input type="hidden" name="incidentLocation" value="<?php echo $_POST['incidentLocation']; ?>"
			</td>
		</tr>
		<tr>
			<td>Incident Type:</td>
			<td>
				<?php echo $_POST['incidentType']; ?>
				<input type="hidden" name="incidentType" value="<?php echo $_POST['incidentType']; ?>"
			</td>
		</tr>
		<tr>
			<td>Description:</td>
			<td>
				<?php echo $_POST['incidentDesc']; ?>
				<input type="hidden" name="incidentDesc" value="<?php echo $_POST['incidentDesc']; ?>"
			</td>
		</tr>
	</table>
<table width="40%" border="1" align="center" cellpadding="4" cellspacing="8">
	<tr>
		<td width="20%">&nbsp;</td>
		<td width="51%">Patrol Car ID</td>
		<td width="29%">Status</td>
	</tr>
	
	<?php 
	$i=0;
		while($i < $count){
		?>
	<tr>
		<td class="td_label"><input type="checkbox" name="chkPatrolcar[]" value="<?php echo $patrolcarArray[$i]['patrolcarid']?>"</td>
		<td><?php echo $patrolcarArray[$i]['patrolcarid']?></td>
		<td><?php echo $patrolcarArray[$i]['statusDesc']?></td>
		</tr>

		<?php $i++;
		} ?>
</table>
<table width="80%" border="0" align="center" cellpadding="4" cellspacing="4">
		<td width="46%" align="right" class="td_label"><input type="reset" name="btnCancel" id="btnCancel" value="Reset"></td>
		<td width="54%" class="td_Data">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="btnSubmit" id="btnSubmit" value="Submit">
		</td>
	</table>
</body>
</html>