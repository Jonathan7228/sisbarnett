<?php
include_once '../connection/Connection.php';

class LogCustomer{
	
	public $intId;
	public $txtDocumentUser;
	public $txtNameUser;
	public $txtDocumentCustomer;
	public $txtFirtsName;
	public $txtSecondName;
	public $txtLastName;
	public $txtSecondLastName;
	public $txtDescription;
	public $tmpDate;
	
	function LogCustomer($intId="",$txtDocumentUser="",$txtNameUser="",$txtDocumentCustomer="",$txtFirtsName="",$txtSecondName="",$txtLastName="",$txtSecondLastName="",$txtDescription="",$tmpDate=""){
		$this->intId = $intId;
		$this->txtDocumentUser=$txtDocumentUser;
		$this->txtNameUser=$txtNameUser;
		$this->txtDocumentCustomer=$txtDocumentCustomer;
		$this->txtFirtsName=$txtFirtsName;
		$this->txtSecondName=$txtSecondName;
		$this->txtLastName=$txtLastName;
		$this->txtSecondLastName=$txtSecondLastName;
		$this->txtDescription=$txtDescription;
		$this->tmpDate=$tmpDate; 
	}
	
	function saveLogCustomer(){
		$conn = new Connection();
		$conn->connect();
		$sql = "INSERT INTO tbl_logcustomer (txtDocumentUser,txtNameUser,txtDocumentCustomer,txtFirtsName,txtSecondName,txtLastName,txtSecondLastName,txtDescription) VALUES ('".$this->txtDocumentUser."','".$this->txtNameUser."','".$this->txtDocumentCustomer."','".$this->txtFirtsName."','".$this->txtSecondName."','".$this->txtLastName."','".$this->txtSecondLastName."','".$this->txtDescription."')";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->query($sql);
		$conn->cleanQuery();
		$conn->disconnect();
		return $resp;
	}
	
	function FindLogCustomer($select,$word){
		$con= new Connection();
		$conectar=$con->connect();
		if($select=='txtDocumentCustomer'){
			$sql = "SELECT * from tbl_logcustomer WHERE txtDocumentCustomer LIKE '%".$word."%'";
		}elseif($select=='txtFirtsName'){
			$sql = "SELECT * from tbl_logcustomer WHERE txtFirtsName LIKE '%".$word."%'";
		}elseif($select=='tmpDate'){
			$sql = "SELECT * from tbl_logcustomer WHERE DATE(tmpDate) = DATE('".$word."')";
		}else{
			$sql = "SELECT * from tbl_logcustomer";
		}
		//echo "<BR>SQL: ".$sql;
		$logs = array();
		$cont = 0;
		$resp = $con->query($sql);
		while ($data = @mysql_fetch_array($resp)){
			$logs[$cont] = new LogCustomer($data['intId'],$data['txtDocumentUser'],$data['txtNameUser'],$data['txtDocumentCustomer'],$data['txtFirtsName'],$data['txtSecondName'],$data['txtLastName'],$data['txtSecondLastName'],$data['txtDescription'],$data['tmpDate']);
			$cont++;
		}
		$con->cleanQuery();
		$con->disconnect();
		return $logs;
	}

}
?>