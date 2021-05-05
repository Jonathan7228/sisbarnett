<?php


class User{
	
	public $intId;
	public $intProfile;
	public $txtDocument;
	public $txtName;
	public $txtPassword;
	public $intStatus;
	public $tmpDate;
	
	
	public function User($intId, $intProfile, $txtDocument, $txtName, $txtPassword, $intStatus, $tmpDate){
		$this->intId=trim($intId);
		$this->intProfile=trim($intProfile);
		$this->txtDocument=trim($txtDocument);
		$this->txtName=trim($txtName);
		$this->txtPassword=trim($txtPassword);	
		$this->intStatus=trim($intStatus);
		$this->tmpDate=trim($tmpDate);		
	}
	
	function authenticate(){
		$con = new Connection();
		$con->connect();
		$sql = "SELECT * FROM tbl_users WHERE txtDocument  = '".$this->txtDocument."' AND txtPassword = md5('".$this->txtPassword."') ";
		//echo "<br>SQL: ".$sql;
        $users = array();
		$cont = 0;
		$resp = $con->query($sql);
        while ($data = @mysql_fetch_array($resp)){
			$users[$cont] = new User($data['intId'],$data['intProfile'],$data['txtDocument'],$data['txtName'],$data['txtPassword'],$data['intStatus'],$data['tmpDate']);
			$cont++;
		}
		$con->cleanQuery();
		$con->disconnect();
		return $users;
	}
	
	function query(){
		$con = new Connection();
		$con->connect();
		$sql = "SELECT * FROM tbl_users WHERE txtDocument  = '".$this->txtDocument."'";
		//echo "<br>SQL: ".$sql;
        $users = array();
		$cont = 0;
		$resp = $con->query($sql);
        while ($data = @mysql_fetch_array($resp)){
			$users[$cont] = new User($data['intId'],$data['intProfile'],$data['txtDocument'],$data['txtName'],$data['txtPassword'],$data['intStatus'],$data['tmpDate']);
			$cont++;
		}
		$con->cleanQuery();
		$con->disconnect();
		return $users;
	}
	
	
	public function saveUser(){
		$con = new Connection();
		$con->connect();
		$sql= "insert into tbl_users (intProfile, txtDocument, txtName, txtPassword) values ('".$this->intProfile."','".$this->txtDocument."','".$this->txtName."',md5('".$this->txtPassword."'))";
		$consul=$con->query($sql);
		$con->cleanQuery();
		$con->disconnect();
		return $consul;
	}
	
	public function existUser(){
		$con= new Connection();
		$conectar=$con->connect();
		$sql= "SELECT * FROM tbl_users WHERE txtDocument='".$this->txtDocument."'";
		$consul=$con->query($sql);
		$num_rows = mysql_num_rows($consul);
		$con->cleanQuery();
		$con->disconnect();
		return $num_rows;
	}
	
	function findUser($select,$word){
		$con= new Connection();
		$conectar=$con->connect();
		if($select=='txtDocument'){
			$sql = "SELECT * from tbl_users WHERE txtDocument LIKE '%".$word."%'";
		}elseif($select=='txtName'){
			$sql = "SELECT * from tbl_users WHERE txtName LIKE '%".$word."%'";
		}elseif($select=='intId'){
			$sql = "SELECT * from tbl_users WHERE intId = '".$word."'";
		}else{
			$sql = "SELECT * from tbl_users";
		}
		//echo "<BR>SQL: ".$sql;
		$user = array();
		$cont = 0;
		$resp = $con->query($sql);
		while ($data = @mysql_fetch_array($resp)){
			$user[$cont] = new User($data['intId'],$data['intProfile'],$data['txtDocument'],$data['txtName'],$data['txtPassword'],$data['intStatus'],$data['tmpDate']);
			$cont++;
		}
		$con->cleanQuery();
		$con->disconnect();
		return $user;
	}
	
	public function editUser(){
		$con= new Connection();
		$conectar=$con->connect();
		$sql= 'UPDATE tbl_users set  txtName="'.$this->txtName.'",intProfile="'.$this->intProfile.'" WHERE intId="'.$this->intId.'"';
		//echo $sql;
		$consul=$con->query($sql);
		$con->cleanQuery();
		$con->disconnect();
		return $consul;
	}
	
	public function editPassUser(){
		$con= new Connection();
		$conectar=$con->connect();
		$sql= 'UPDATE tbl_users set  txtPassword= md5("'.$this->txtPassword.'")  WHERE intId="'.$this->intId.'"';
		//echo $sql;
		$consul=$con->query($sql);
		$con->cleanQuery();
		$con->disconnect();
		return $consul;
	}
	
	public function activateDesactivateUser($value){
		$con= new Connection();
		$conectar=$con->connect();
		$sql= 'UPDATE tbl_users set intStatus="'.$value.'" where intId="'.$this->intId.'"';
		$consul=$con->query($sql);
		$con->cleanQuery();
		$con->disconnect();
		return $consul;
	}

}
?>