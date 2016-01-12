
<?php

require_once("../config_global.php");
	$database= "if15_mats_3";
	
	function getCarData($keyword=""){
		
		$search = "%%";
		
		
		if($keyword == ""){
			
			echo "Ei otsi";
		}else{
			echo "Otsin ".$keyword;
			$search= "%".$keyword."%";
		}
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt= $mysqli->prepare("SELECT id, user_id, car_number, date, traveldistance, comment from cardata WHERE deleted IS NULL AND car_number LIKE ? OR traveldistance LIKE ?");
		echo $mysqli->error;
		$stmt->bind_param("ss",$search, $search);
		$stmt->bind_result($id, $user_id_from_database, $carnumber, $date, $traveldistance, $comment);
		$stmt->execute();
		
		//tekitan  tühja massiivi kus edaspidi hoian objekte
		$car_array = array();
		
		//$row= 0;
		
		//tee midagi seni, kuni saame ab'ist ühe rea andmeid
		while($stmt->fetch()){
			//seda siin sees tehakse
			//nii mitu korda kui on ridu
			
			//echo $row."".$number_plate."<br>";
			//$row=$row + 1;
			//$row +=1;
			//row++;
			$car = new StdClass();
			$car->id= $id;
			$car->carnumber = $carnumber;
			$car->dates = $date;
			$car->user_id= $user_id_from_database;
			$car->traveldistance= $traveldistance;
			$car->comment=$comment;
			//lisan massiivi
			
			array_push($car_array, $car);
			//var dump ütleb muutuja sisu
			//echo"<pre>";
			//var_dump ($car_array);
			//echo"</pre><br>";
		
		}
		
		//tagastan massiivi,kus kõik read sees
		return $car_array;
		
		$stmt->close();
		$mysqli->close();
		
	}
	
	function deleteCardata($id){
	$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
	
	$stmt = $mysqli->prepare("UPDATE cardata SET deleted=NOW() WHERE id=?");
	$stmt->bind_param("i", $id);
	if($stmt->execute()){
		
		header("Location: cartable.php");
		
	}
	$stmt->close();
	$mysqli->close();
	
	
	
	}
	
	function updateCardata ($id, $carnumber, $date, $traveldistance, $comment){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE cardata SET carnumber=?, date=?, traveldistance=?, comment=?  WHERE id=?");
        $stmt->bind_param("ssi", $carnumber, $date, $traveldistance, $comment, $id);
        if($stmt->execute()){
			
		
        
        // tühjendame aadressirea
        header("Location: cartable.php");
        }
        $stmt->close();
        $mysqli->close();
		
		
	}
	//käivitan funktsiooni
	
?>	
	
