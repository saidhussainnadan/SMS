<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "con";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM cell";
$result = $conn->query($sql);

?>



<!DOCTYPE html>
<html>
<head>
	<title>SMS APP</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
</head>
<script type="text/javascript">
	function chech_all(){
		var ch = document.getElementById("all");
		var al = document.getElementsByClassName("each");
		if(ch.checked){
			for(var i=0; i<al.length; i++){
				al[i].checked=true;
			}
		}else{
			for(var i=0; i<al.length; i++){
				al[i].checked=false;
			}

		}
	}

</script>





<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand"  href="sms.php">Welcome to SMS APP</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  
  </div>
</nav>
<div class="container">
	


<form action="sms.php" method="post">

<table class="table table-hover">
  
  <tbody>
    <tr class="table-active">
      <th scope="row">All-<input type="checkbox" onchange="chech_all()" id="all" name="all"></th>
      <td>Phone Number</td>
      <td>Status</td>
      <td>Message</td>
    </tr>
    <?php
	if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) { 

		$val = $row["phone"].",".$row["message"];
		?>

		
    	
        <tr class="table-light">
      <th scope="row"><?php  echo $row["id"]; ?>-<input type="checkbox" name="Check[]" class="each" value="<?php echo $val; ?>"></th>

      <td><?php  echo $row["phone"]; ?></td>
      <td><?php  if($row["status"]==0){
			echo "Not Sent";
		}else{
			echo "Sent";
		} ?></td>
      <td><?php  echo $row["message"]; ?></td>
      <input type="hidden" name="m[]" value="<?php  echo $row["message"]; ?>">
    </tr>
    <?php } }
else{
	echo "0 rows";
}
 ?>
 <tr>
 	<td colspan="4"><input type="submit" name="send" class="btn btn-success" style="margin-left: 40%;" value="Send SMS"></td>
 </tr>
  </tbody>

</table> 
</form>


  
</div>




</div>
</div>
</body>
</html>


<?php


	
 $_objSmsProtocolGsm = new COM("ActiveXperts.SmsProtocolGsm");
        $objMessage   = new COM ("ActiveXperts.SmsMessage");
		$objConstants = new COM ("ActiveXperts.SmsConstants");
       $device       = "GlobeTrotter GI4xx - Modem Interface";
		$speed        = "Default";
		$pincode      = "";


	if(isset($_POST['Check']))
	foreach($_POST['Check'] as $each_check){
	
		$val = explode(",", $each_check );
       
		$recipient    = "+92" . $val[0];
		
		$message = $val[1]; 
		
		echo "this is number ----".$recipient."<br>";
		echo "this is msg ----".$message."<br>";
		
		$unicode      = "";
		$_objSmsProtocolGsm->Logfile = "C:\SMSMMSToolLog.txt";
		$objMessage->Clear();
				if( $recipient == "" ) die("No recipient address filled in."); 
		$objMessage->Recipient = $recipient;
		
		//fill in the messageformat
		if( $unicode != "" ) $objMessage->Format = $objConstants->asMESSAGEFORMAT_UNICODE;
		
		//fill in the message body
		$objMessage->Data = $message;
	
		//clear the gsm object
		$_objSmsProtocolGsm->Clear();
		
		//fill in the devicename
		$_objSmsProtocolGsm->Device = $device;
		
		//fill in the devicespeed
		if( $speed == "Default" ) $_objSmsProtocolGsm->DeviceSpeed = 0;
		if( $speed != "Default" ) $_objSmsProtocolGsm->DeviceSpeed = $speed;
		
		//fill in the pincode
		if( $pincode != "" ) $_objSmsProtocolGsm->EnterPin( $pincode );
		
		//send the message
		if( $_objSmsProtocolGsm->LastError == 0 ){
			
        	$_objSmsProtocolGsm->Send( $objMessage );
       $sql = "UPDATE `con`.`cell` SET `status` = '1' WHERE `cell`.`phone` = $each_check;";
		$re = $conn->query($sql);

        	
		}
		
		//get the results
		$LastError        = $_objSmsProtocolGsm->LastError;
		$ErrorDescription = $_objSmsProtocolGsm->GetErrorDescription( $LastError );
		
		 $sql = "UPDATE `con`.`cell` SET `error` = $LastError  WHERE `cell`.`phone` = $each_check;";
			$re = $conn->query($sql);
			
		 $sql = "UPDATE `con`.`cell` SET `Eror_description` = '$ErrorDescription'  WHERE `cell`.`phone` = $each_check;";
			$re = $conn->query($sql);
			 $sql = "UPDATE `con`.`cell` SET `status` = '0' WHERE `cell`.`phone` = $each_check;";
		$re = $conn->query($sql);

	}
 	













$conn->close();
?>
