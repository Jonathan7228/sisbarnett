<?php
include_once '../connection/Connection.php';

class Inventory{
	
	public $intId;
	public $intIdProduct;
	public $intQuantity;
	public $tmpDate;	
	
	function Inventory($intId="",$intIdProduct="",$intQuantity="",$tmpDate=""){
		$this->intId = $intId;
		$this->intIdProduct=$intIdProduct;
		$this->intQuantity=$intQuantity;
		$this->tmpDate=$tmpDate; 
	}
	
	function addInventory(){
		$conn = new Connection();
		$conn->connect();
		$sql = "INSERT INTO tbl_inventory (intIdProduct,intQuantity) VALUES ('".$this->intIdProduct."','".$this->intQuantity."')";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->query($sql);
		$id = mysql_insert_id(); 
		$conn->cleanQuery();
		$conn->disconnect();
		return $id;
	}
	
	public function editInventory(){
		$conn = new Connection();
		$conn->connect();
		$sql= 'UPDATE tbl_inventory set intQuantity="'.$this->intQuantity.'"  WHERE intIdProduct="'.$this->intIdProduct.'"';
		//echo $sql;
		$resp = $conn->query($sql);
		if($resp){
			$sql = "SELECT intId from tbl_inventory WHERE intIdProduct = '".$this->intIdProduct."'";
			$resp1 = $conn->query($sql);
			$row = mysql_fetch_row($resp1);
			
		} 
		$conn->cleanQuery();
		$conn->disconnect();
		return $row[0];
	}
	
	function FindProductInventory(){
		$con= new Connection();
		$conectar=$con->connect();
		$sql = "SELECT * from tbl_inventory WHERE intIdProduct = '".$this->intIdProduct."'";
		//echo "<BR>SQL: ".$sql;
		$inventory = array();
		$cont = 0;
		$resp = $con->query($sql);
		while ($data = @mysql_fetch_array($resp)){
			$inventory[$cont] = new Inventory($data['intId'],$data['intIdProduct'],$data['intQuantity'],$data['tmpDate']);
			$cont++;
		}
		$con->cleanQuery();
		$con->disconnect();
		return $inventory;
	}
	
	public function subtractInventory(){
		$conn = new Connection();
		$conn->connect();
		$sql= 'UPDATE tbl_inventory set intQuantity=intQuantity-"'.$this->intQuantity.'"  WHERE intIdProduct="'.$this->intIdProduct.'"';
		//echo $sql;
		$resp = $conn->query($sql);
		$conn->cleanQuery();
		$conn->disconnect();
		return $resp;
	}


}
?>