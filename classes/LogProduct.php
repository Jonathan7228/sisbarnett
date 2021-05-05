<?php
include_once '../connection/Connection.php';

class LogProduct{
	
	public $intId;
	public $txtDocumentUser;
	public $txtNameUser;
	public $txtCod;
	public $txtNameProduct;
	public $dbValue;
	public $txtDescription;	
	public $tmpDate;
	
	function LogProduct($intId="",$txtDocumentUser="",$txtNameUser="",$txtCod="",$txtNameProduct="",$dbValue="",$txtDescription="",$tmpDate=""){
		$this->intId = $intId;
		$this->txtDocumentUser=$txtDocumentUser;
		$this->txtNameUser=$txtNameUser;
		$this->txtCod=$txtCod;
		$this->txtNameProduct=$txtNameProduct;
		$this->dbValue=$dbValue;
		$this->txtDescription=$txtDescription;
		$this->tmpDate=$tmpDate; 
	}
	
	function saveLogProduct(){
		$conn = new Connection();
		$conn->connect();
		$sql = "INSERT INTO tbl_logproduct (txtDocumentUser,txtNameUser,txtCod,txtNameProduct,dbValue,txtDescription) VALUES ('".$this->txtDocumentUser."','".$this->txtNameUser."','".$this->txtCod."','".$this->txtNameProduct."','".$this->dbValue."','".$this->txtDescription."')";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->query($sql);
		$conn->cleanQuery();
		$conn->disconnect();
		return $resp;
	}
	
	function FindLogProduct($select,$word){
		$con= new Connection();
		$conectar=$con->connect();
		if($select=='txtCod'){
			$sql = "SELECT * from tbl_logproduct WHERE txtCod LIKE '%".$word."%'";
		}elseif($select=='txtNameProduct'){
			$sql = "SELECT * from tbl_logproduct WHERE txtNameProduct LIKE '%".$word."%'";
		}elseif($select=='tmpDate'){
			$sql = "SELECT * from tbl_logproduct WHERE DATE(tmpDate) = DATE('".$word."')";
		}else{
			$sql = "SELECT * from tbl_logproduct";
		}
		//echo "<BR>SQL: ".$sql;
		$logs = array();
		$cont = 0;
		$resp = $con->query($sql);
		while ($data = @mysql_fetch_array($resp)){
			$logs[$cont] = new LogProduct($data['intId'],$data['txtDocumentUser'],$data['txtNameUser'],$data['txtCod'],$data['txtNameProduct'],$data['dbValue'],$data['txtDescription'],$data['tmpDate']);
			$cont++;
		}
		$con->cleanQuery();
		$con->disconnect();
		return $logs;
	}

}
?>