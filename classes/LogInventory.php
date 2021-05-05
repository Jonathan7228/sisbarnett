<?php
include_once '../connection/Connection.php';

class LogInventory{
	
	public $intId;
	public $txtDocumentUser;
	public $txtNameUser;
	public $txtCodProduct;
	public $txtDescriptionProduct;
	public $intQuantity;
	public $tmpDate;
	
	function LogInventory($intId="",$txtDocumentUser="",$txtNameUser="",$txtCodProduct="",$txtDescriptionProduct="",$intQuantity="",$tmpDate=""){
		$this->intId = $intId;
		$this->txtDocumentUser=$txtDocumentUser;
		$this->txtNameUser=$txtNameUser;
		$this->txtCodProduct=$txtCodProduct;
		$this->txtDescriptionProduct=$txtDescriptionProduct;
		$this->intQuantity=$intQuantity;
		$this->tmpDate=$tmpDate; 
	}
	
	function saveLogInventory(){
		$conn = new Connection();
		$conn->connect();
		$sql = "INSERT INTO tbl_loginventory (txtDocumentUser,txtNameUser,txtCodProduct,txtDescriptionProduct,intQuantity) VALUES ('".$this->txtDocumentUser."','".$this->txtNameUser."','".$this->txtCodProduct."','".$this->txtDescriptionProduct."','".$this->intQuantity."')";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->query($sql);
		$conn->cleanQuery();
		$conn->disconnect();
		return $resp;
	}
	
	function FindLogInventory($select,$word){
		$con= new Connection();
		$conectar=$con->connect();
		if($select=='txtCodProduct'){
			$sql = "SELECT * from tbl_loginventory WHERE txtCodProduct LIKE '%".$word."%'";
		}elseif($select=='txtDescriptionProduct'){
			$sql = "SELECT * from tbl_loginventory WHERE txtDescriptionProduct LIKE '%".$word."%'";
		}elseif($select=='tmpDate'){
			$sql = "SELECT * from tbl_loginventory WHERE DATE(tmpDate) = DATE('".$word."')";
		}else{
			$sql = "SELECT * from tbl_loginventory";
		}
		//echo "<BR>SQL: ".$sql;
		$logs = array();
		$cont = 0;
		$resp = $con->query($sql);
		while ($data = @mysql_fetch_array($resp)){
			$logs[$cont] = new LogInventory($data['intId'],$data['txtDocumentUser'],$data['txtNameUser'],$data['txtCodProduct'],$data['txtDescriptionProduct'],$data['intQuantity'],$data['tmpDate']);
			$cont++;
		}
		$con->cleanQuery();
		$con->disconnect();
		return $logs;
	}

}
?>