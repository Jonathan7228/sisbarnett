<?php
include_once '../connection/Connection.php';

class LogOrder{
	
	public $intId;
	public $txtDocumentUser;
	public $txtNameUser;
	public $intIdOrder;
	public $txtDescription;	
	public $tmpDate;
	
	function LogOrder($intId="",$txtDocumentUser="",$txtNameUser="",$intIdOrder="",$txtDescription="",$tmpDate=""){
		$this->intId = $intId;
		$this->txtDocumentUser=$txtDocumentUser;
		$this->txtNameUser=$txtNameUser;
		$this->intIdOrder=$intIdOrder;
		$this->txtDescription=$txtDescription;
		$this->tmpDate=$tmpDate; 
	}
	
	function saveLogOrder(){
		$conn = new Connection();
		$conn->connect();
		$sql = "INSERT INTO tbl_logorder (txtDocumentUser,txtNameUser,intIdOrder,txtDescription) VALUES ('".$this->txtDocumentUser."','".$this->txtNameUser."','".$this->intIdOrder."','".$this->txtDescription."')";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->query($sql);
		$conn->cleanQuery();
		$conn->disconnect();
		return $resp;
	}
	
	function FindLogOrder($select,$word){
		$con= new Connection();
		$conectar=$con->connect();
		if($select=='intIdOrder'){
			$sql = "SELECT * from tbl_logorder WHERE intIdOrder LIKE '%".$word."%'";
		}elseif($select=='tmpDate'){
			$sql = "SELECT * from tbl_logorder WHERE DATE(tmpDate) = DATE('".$word."')";
		}else{
			$sql = "SELECT * from tbl_logorder";
		}
		//echo "<BR>SQL: ".$sql;
		$logs = array();
		$cont = 0;
		$resp = $con->query($sql);
		while ($data = @mysql_fetch_array($resp)){
			$logs[$cont] = new LogOrder($data['intId'],$data['txtDocumentUser'],$data['txtNameUser'],$data['intIdOrder'],$data['txtDescription'],$data['tmpDate']);
			$cont++;
		}
		$con->cleanQuery();
		$con->disconnect();
		return $logs;
	}

}
?>