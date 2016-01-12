
<?php
	
	require_once("../config_global.php");
	$database= "if15_mats_3";

	
	function getEditData($edit_id){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt=$mysqli->prepare("SELECT car_number FROM cardata WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("i",$edit_id);
		$stmt->bind_result($carnumber);
		$stmt->execute();
		
		$cars=new StdClass();
	
		if($stmt->fetch()){
			
			$carnumber->carnumber=$carnumber;
		
			
		}else{	
			header("Location:cartable.php");
			
		}
		return $cars;
		
		$stmt->close();
		$mysqli->close();
	}
		
	function updateCardata($id, $carnumber, $date, $traveldistance, $comment){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE cardata SET car_number=?, date=?, traveldistance=?, comment=? WHERE id=?");
		$stmt->bind_param("ssssi", $carnumber, $date, $traveldistance, $comment,  $id);
		if($stmt->execute()){
			// sai uuendatud
			// kustutame aadressirea tühjaks
			header("Location: cartable.php");
			
		}
		
		$stmt->close();
		$mysqli->close();
	}



?>