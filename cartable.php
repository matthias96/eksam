<?php
	require_once("functions.php");
	require_once("tablefunctions.php");
	
	
	
	
	if(isset($_GET["delete"])){
		
		echo "Kustutame id ".$_GET["delete"];
		
		deleteCar($_GET["delete"]);
		
	}
	if(isset($_POST["save"])){
		
		updateCar($_POST["id"], $_POST["carnumber"],$_POST["date"],$_POST["traveldistance"],$_POST["comment"]);
		
	}
	$keyword= "";
	if(isset($_GET["keyword"])){
		
		//otsin
		$keyword = $_GET["keyword"];
		$array_of_cars = getCarData($keyword);
		
	}else{
		$array_of_cars=getCarData();
	
	}

?>
<a href="data.php">Lisa uued autoandmed</a>
<h2>Tabel</h2>
<form action="cartable.php" method="get" >
	<input type="search" name="keyword" value="<?=$keyword;?>" >
	<input type="submit">
</form>

<table border=1 >
	<tr>
		<th>id</th>
		<th>kasutaja id</th>
		<th>Autonumber</th>
		<th>Kuupäev</th>
		<th>Läbisõit</th>
		<th>Kommentaar</th>
		<th>X</th>
		<th></th>
	</tr>
<?php
		
	for($i=0; $i< count($array_of_cars) ; $i++){
			
			
		if(isset($_GET["edit"]) && $array_of_cars[$i]->id == $_GET["edit"]){
				
			echo"<tr>";
			echo"<form action='cartable.php' method='post'>";
			echo"<input type='hidden' name='id' value='".$array_of_cars[$i]->id."'>";
			echo"<td>".$array_of_cars[$i]->id."</td>";
			echo"<td>".$array_of_cars[$i]->user_id."</td>";
			echo"<td><input name='carnumber' value='".$array_of_cars[$i]->carnumber."'></td>";
			echo"<td><input name='date' value='".$array_of_cars[$i]->date."'></td>";
			echo"<td><input name='traveldistance' value='".$array_of_cars[$i]->traveldistance."'></td>";
			echo"<td><input name='comment' value='".$array_of_cars[$i]->comment."'></td>";
			echo"<td><a href='cartable.php'>cancel<a></td>";
			echo"<td><input type='submit' name='save'></td>";
			echo"</form>";
			echo"</tr>";
				
		}else{
				echo"<tr>";
					echo"<td>".$array_of_cars[$i]->id."</td>";
					echo"<td>".$array_of_cars[$i]->user_id."</td>";
					echo"<td>".$array_of_cars[$i]->carnumber."</td>";
					echo"<td>".$array_of_cars[$i]->date."</td>";
					echo"<td>".$array_of_cars[$i]->traveldistance."</td>";
					echo"<td>".$array_of_cars[$i]->comment."</td>";
					echo"<td><a href='?delete=".$array_of_cars[$i]->id."'>X</a></td>";
					echo"<td><a href='?edit=".$array_of_cars[$i]->id."'>edit</a></td>";
					echo"<td><a href='edit.php?edit_id=".$array_of_cars[$i]->id."'>edit.php</a></td>";
					echo"</tr>";
		}
			
			
			echo"</tr>";
				
				
				
		}
				
				
	}
			
			
			
	
	
?>
</table>