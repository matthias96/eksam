<?php
   require_once("functions.php");
   if(!isset($_SESSION["logged_in_user_id"])){
		header("Location: login.php");
		
	}
	//kasutaja tahab välja logida
	if(isset($_GET["logout"])){
		//addressireal on olemas muutuja logout
		//kustutame kõik sessioonimuutujad
		session_destroy();
		header("Location: login.php");
	}
   $carnumber="";
   $carnumber_error= "";
   $date="";
   $date_error="";
   $traveldistance="";
   $traveldistance_error="";
   $comment="";
   $comment_error="";
   if($_SERVER["REQUEST_METHOD"] == "POST") {

   
		if(isset($_POST["add_cardata"])){

			

			if ( empty($_POST["carnumber"])) {
				$carnumber_error = "See väli on kohustuslik";
			}else{
        
				$carnumber = cleanInput($_POST["carnumber"]);
			}

			if ( empty($_POST["date"]) ) {
				$date_error = "See väli on kohustuslik";
			}else{
				$date = cleanInput($_POST["date"]);
			}
			if ( empty($_POST["traveldistance"]) ) {
				$traveldistance_error = "See väli on kohustuslik";
			}else{
				$traveldistance = cleanInput($_POST["traveldistance"]);
			}
			if ( empty($_POST["comment"]) ) {
				$comment_error = "See väli on kohustuslik";
			}else{
				$comment = cleanInput($_POST["comment"]);
			}
			
			if($carnumber_error == "" && $date_error == "" && $traveldistance_error == "" && $comment_error =="" ){
				
				$msg= createCardata($carnumber, $date, $traveldistance, $comment);
				
				if($msg !=""){
					//õnnestus, teeme inputi väljad tühjaks
					$carnumber="";
					$date="";
					$traveldistance="";
					$comment="";
					
					echo $msg;
				}
				
			}
		}			
		
	}	
		
		
		
	   
	 
	   
	   

   function cleanInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
	
	
   
 ?> 
 <a href="poststable.php">Auto andmete sisestamine</a>
 <p>Tere, <?=$_SESSION["logged_in_user_email"];?>
	<a href="?logout=1"> Logi välja <a>
</p>

<h2>Lisa auto andmed </h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<label for="carnumber">Auto numbrimärk</label><br>
  	<input id="carnumber" name="carnumber" type="text"  value="<?php echo $carnumber; ?>"> <?php echo $carnumber_error; ?><br><br>
	<label for="date">Kuupäev</label><br>
  	<input id="date" name="date" type="date"  value="<?php echo $date; ?>"> <?php echo $date_error; ?><br><br>
	<label for="traveltdistance">Läbisõit</label><br>
  	<input id="traveldistance" name="traveldistance" type="text"  value="<?php echo $traveldistance; ?>"> <?php echo $traveldistance_error; ?><br><br>
	<label for="comment">Kommentaar</label><br>
  	<input id="comment" name="comment" type="text"  value="<?php echo $comment; ?>"> <?php echo $comment_error; ?><br><br>
  	<input type="submit" name="add_cardata" value="Salvesta">
  </form>
	
  
