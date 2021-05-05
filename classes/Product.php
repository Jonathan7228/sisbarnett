<?php
include_once '../connection/Connection.php';

class Product{
	
	public $intId;
	public $txtCod;
	public $txtDescription;
	public $dbValue;
	public $txtObservation;
	public $tmpDate;
	public $intState;	
	
	function Product($intId="",$txtCod="",$txtDescription="",$dbValue="",$txtObservation="",$tmpDate="",$intState=""){
		$this->intId = $intId;
		$this->txtCod=$txtCod;
		$this->txtDescription=$txtDescription;
		$this->dbValue=$dbValue;
		$this->txtObservation=$txtObservation;
		$this->tmpDate=$tmpDate;
		$this->intState = $intState; 
	}
	
	function saveProduct(){
		$conn = new Connection();
		$conn->connect();
		$sql = "INSERT INTO tbl_product (txtCod,txtDescription,dbValue,txtObservation) VALUES ('".$this->txtCod."','".$this->txtDescription."','".$this->dbValue."','".$this->txtObservation."')";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->query($sql);
		if($resp){$id = mysql_insert_id();}
		$conn->cleanQuery();
		$conn->disconnect();
		return $id;
	}
	
	public function editProduct(){
		$conn = new Connection();
		$conn->connect();
		$sql= 'UPDATE tbl_product set txtDescription="'.$this->txtDescription.'", dbValue="'.$this->dbValue.'", txtObservation="'.$this->txtObservation.'"  WHERE intId="'.$this->intId.'"';
		//echo $sql;
		$resp = $conn->query($sql);
		$conn->cleanQuery();
		$conn->disconnect();
		return $resp;
	}
	
	public function existProduct(){
		$con= new Connection();
		$conectar=$con->connect();
		$sql= "SELECT * FROM tbl_product WHERE txtCod='".$this->txtCod."'";
		$consul=$con->query($sql);
		$num_rows = mysql_num_rows($consul);
		$con->cleanQuery();
		$con->disconnect();
		return $num_rows;
	}
	
	function FindProduct($select,$word){
		$con= new Connection();
		$conectar=$con->connect();
		if($select=='txtCod'){
			$sql = "SELECT * from tbl_product WHERE txtCod LIKE '%".$word."%'";
		}elseif($select=='txtDescription'){
			$sql = "SELECT * from tbl_product WHERE txtDescription LIKE '%".$word."%'";
		}elseif($select=='id'){
			$sql = "SELECT * from tbl_product WHERE intId = '".$word."'";
		}else{
			$sql = "SELECT * from tbl_product";
		}
		//echo "<BR>SQL: ".$sql;
		$product = array();
		$cont = 0;
		$resp = $con->query($sql);
		while ($data = @mysql_fetch_array($resp)){
			$product[$cont] = new Product($data['intId'],$data['txtCod'],$data['txtDescription'],$data['dbValue'],$data['txtObservation'],$data['tmpDate'],$data['intState']);
			$cont++;
		}
		$con->cleanQuery();
		$con->disconnect();
		return $product;
	}
	
	public function activateDesactivateProduct($value){
		$con= new Connection();
		$conectar=$con->connect();
		$sql= 'UPDATE tbl_product set intState="'.$value.'" where intId="'.$this->intId.'"';
		//echo $sql;
		$resp = $con->query($sql);;
		$con->cleanQuery();
		$con->disconnect();
		return $resp;
	}
}
?>