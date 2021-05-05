<?php
include_once '../connection/Connection.php';

class LogUser{
	
	public $intId;
	public $txtDocumentUser;
	public $txtNameUser;
	public $txtDocument;
	public $txtName;
	public $txtDescription;	
	public $tmpDate;
	
	function LogUser($intId="",$txtDocumentUser="",$txtNameUser="",$txtDocument="",$txtName="",$txtDescription="",$tmpDate=""){
		$this->intId = $intId;
		$this->txtDocumentUser=$txtDocumentUser;
		$this->txtNameUser=$txtNameUser;
		$this->txtDocument=$txtDocument;
		$this->txtName=$txtName;
		$this->txtDescription=$txtDescription;
		$this->tmpDate=$tmpDate; 
	}
	
	function saveLogUser(){
		$conn = new Connection();
		$conn->connect();
		$sql = "INSERT INTO tbl_loguser (txtDocumentUser,txtNameUser,txtDocument,txtName,txtDescription) VALUES ('".$this->txtDocumentUser."','".$this->txtNameUser."','".$this->txtDocument."','".$this->txtName."','".$this->txtDescription."')";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->query($sql);
		$conn->cleanQuery();
		$conn->disconnect();
		return $resp;
	}
	
	function FindLogUser($select,$word){
		$con= new Connection();
		$conectar=$con->connect();
		if($select=='txtDocument'){
			$sql = "SELECT * from tbl_loguser WHERE txtDocument LIKE '%".$word."%'";
		}elseif($select=='txtName'){
			$sql = "SELECT * from tbl_loguser WHERE txtName LIKE '%".$word."%'";
		}elseif($select=='tmpDate'){
			$sql = "SELECT * from tbl_loguser WHERE DATE(tmpDate) = DATE('".$word."')";
		}else{
			$sql = "SELECT * from tbl_loguser";
		}
		//echo "<BR>SQL: ".$sql;
		$logs = array();
		$cont = 0;
		$resp = $con->query($sql);
		while ($data = @mysql_fetch_array($resp)){
			$logs[$cont] = new LogUser($data['intId'],$data['txtDocumentUser'],$data['txtNameUser'],$data['txtDocument'],$data['txtName'],$data['txtDescription'],$data['tmpDate']);
			$cont++;
		}
		$con->cleanQuery();
		$con->disconnect();
		return $logs;
	}

}
?>