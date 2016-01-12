<?php
class CarManager{
	
	
		private $connection;
		private $user_id;
		
		function __construct($mysqli, $user_id_from_session){
			
			$this->connection=$mysqli;
			$this->user_id=$user_id_from_session;
			
			echo "Autode haldus käivitatud, kasutaja=".$this->user_id;
			
		}
			
			
		
		function createDropdown(){
			
			$html= '';
			$html .='<select name="new_dd_selection">';
			
			//$html .='<option>1</option>';
			//$html .='<option>2</option>';
			//$html .='<option>3</option>';
			$stmt=$this->connection->prepare("SELECT id, car_number FROM cardata");
			$stmt->bind_result($id, $car_number);
			$stmt->execute();
			
			while($stmt->fetch()){
				$html .='<option>'.$car_number.'</option>';
			}
			
			$html .= '</select>';
			
			return $html;
		}
		
		
		// sai edukalt salvestatud
		
			
			
			
		}
		


?>