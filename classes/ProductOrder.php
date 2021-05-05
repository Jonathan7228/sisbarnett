<?php
include_once '../connection/Connection.php';

class ProductOrder{
	
	public $intId;
	public $intIdOrder;
	public $intIdProduct;
	public $intQuantity;
	public $dbSubtotal;	
	
	function ProductOrder($intId="",$intIdOrder="",$intIdProduct="",$intQuantity="",$dbSubtotal=""){
		$this->intId = $intId;
		$this->intIdOrder=$intIdOrder;
		$this->intIdProduct=$intIdProduct;
		$this->intQuantity=$intQuantity;
		$this->dbSubtotal=$dbSubtotal;
	}
	
	function saveProductOrder(){
		$conn = new Connection();
		$conn->connect();
		$sql = "INSERT INTO tbl_products_order (intIdOrder,intIdProduct,intQuantity,dbSubtotal) VALUES ('".$this->intIdOrder."','".$this->intIdProduct."','".$this->intQuantity."','".$this->dbSubtotal."')";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->query($sql);
		$conn->cleanQuery();
		$conn->disconnect();
		return $resp;
	}
	
	function FindProductOrder($select,$word){
		$con= new Connection();
		$conectar=$con->connect();
		if($select=='intIdOrder'){
			$sql = "SELECT * from tbl_products_order WHERE intIdOrder = '".$word."'";
		}else{
			$sql = "SELECT * from tbl_customer";
		}
		//echo "<BR>SQL: ".$sql;
		$products = array();
		$cont = 0;
		$resp = $con->query($sql);
		while ($data = @mysql_fetch_array($resp)){
			$products[$cont] = new ProductOrder($data['intId'],$data['intIdOrder'],$data['intIdProduct'],$data['intQuantity'],$data['dbSubtotal']);
			$cont++;
		}
		$con->cleanQuery();
		$con->disconnect();
		return $products;
	}

}
?>