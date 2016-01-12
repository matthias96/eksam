<?php
	
	require_once("edit_functions.php");
	
	if(isset($_POST["update_carnumber"])){	
			updateCardata($_POST["id"], $_POST["carnumber"]);
	}		
	
	if(isset($_GET["edit_id"])){
		echo $_GET ["edit_id"];
		
		$posts=getEditData($_GET ["edit_id"]);
		var_dump($posts);
	}else{
		echo "VIGA";
		
		header("Location:cartable.php");
	}
	

?>
<h2>Muuda autonumbrit</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
		<input type="hidden" name="id" value="<?=$_GET["edit_id"];?>">
		<label for="carnumber">Autonumber</label><br>
		<input id="carnumber" name="carnumber" type="text"  value="<?=$car->car;?>"> <br><br>
		<input type="submit" name="update_post" value="Salvesta">
  </form>	