
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
	<title>SMS APPLICATION</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h2>
		Welcome To Tapsol Messaging App
	</h2>
	<hr>
<form action="index.php" method="post">
<table border="1" width="500">
	<tr>
		<th>All-<input type="checkbox" name="all"></th>
		<th> Number </th>
		<th> Status </th>
	</tr>
	<?php
	if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) { ?>

         
    
	<tr>
		<td style="text-align: center;"><?php  echo $row["id"]; ?>-<input type="checkbox" name="Check[]" value="<?php echo $row["phone"]; ?>"> </td>
		<td style="text-align: center;"><?php  echo $row["phone"]; ?></td>
		<td style="text-align: center;"><?php  if($row["status"]==0){
			echo "Not Sent";
		}else{
			echo "Sent";
		} ?></td>
	</tr>

<?php } }
else{
	echo "0 rows";
}
 ?>
<tr>
	<td colspan="3" style="text-align: center;"><input type="submit" name="send" value="Send SMS">

	</td>
	</tr>

</table>
</form>
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
	

       
		$recipient    = "+92" . $each_check;
		
		$message = "this is message from tapsol.com";  
		
	
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

	}
 	













$conn->close();
?>


