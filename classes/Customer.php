<?php
include_once '../connection/Connection.php';

class Customer{
	
	public $intId;
	public $txtTypePerson;
	public $txtTypeDocument;
	public $txtDocument;
	public $txtFirtsName;
	public $txtSecondName;
	public $txtLastName;
	public $txtSecondLastName;
	public $txtaddress;
	public $txtCity;
	public $txtPhone;
	public $txtCelPhone;
	public $txtEmail;
	public $txtObservation;
	public $tmpDate;
	public $intState;	
	
	function Customer($intId="",$txtTypePerson="",$txtTypeDocument="",$txtDocument="",$txtFirtsName="",$txtSecondName="",$txtLastName="",$txtSecondLastName="",$txtaddress="",$txtCity="",$txtPhone="",$txtCelPhone="",$txtEmail="",$txtObservation="",$tmpDate="",$intState=""){
		$this->intId = $intId;
		$this->txtTypePerson=$txtTypePerson;
		$this->txtTypeDocument=$txtTypeDocument;
		$this->txtDocument=$txtDocument;
		$this->txtFirtsName=$txtFirtsName;
		$this->txtSecondName = $txtSecondName; 
		$this->txtLastName=$txtLastName;
		$this->txtSecondLastName = $txtSecondLastName;
		$this->txtaddress = $txtaddress;
		$this->txtCity = $txtCity;
		$this->txtPhone = $txtPhone;
		$this->txtCelPhone = $txtCelPhone;
		$this->txtEmail = $txtEmail;
		$this->txtObservation = $txtObservation;
		$this->tmpDate = $tmpDate;
		$this->intState = $intState;
	}
	
	function saveCustomer(){
		$conn = new Connection();
		$conn->connect();
		$sql = "INSERT INTO tbl_customer (txtTypePerson,txtTypeDocument,txtDocument,txtFirtsName,txtSecondName,txtLastName,txtSecondLastName,txtaddress,txtCity,txtPhone,txtCelPhone,txtEmail,txtObservation) VALUES ('".$this->txtTypePerson."','".$this->txtTypeDocument."','".$this->txtDocument."','".$this->txtFirtsName."','".$this->txtSecondName."','".$this->txtLastName."','".$this->txtSecondLastName."','".$this->txtaddress."','".$this->txtCity."','".$this->txtPhone."','".$this->txtCelPhone."','".$this->txtEmail."','".$this->txtObservation."')";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->query($sql);
		if($resp){$id = mysql_insert_id();}
		$conn->cleanQuery();
		$conn->disconnect();
		return $id;
	}
	
	public function editCustomer(){
		$conn = new Connection();
		$conn->connect();
		$sql= 'UPDATE tbl_customer set  txtFirtsName="'.$this->txtFirtsName.'",txtSecondName="'.$this->txtSecondName.'", txtLastName="'.$this->txtLastName.'", txtSecondLastName="'.$this->txtSecondLastName.'", txtaddress="'.$this->txtaddress.'", txtCity="'.$this->txtCity.'", txtPhone="'.$this->txtPhone.'", txtCelPhone="'.$this->txtCelPhone.'", txtEmail="'.$this->txtEmail.'", txtObservation="'.$this->txtObservation.'"  WHERE intId="'.$this->intId.'"';
		//echo $sql;
		$resp = $conn->query($sql);
		$conn->cleanQuery();
		$conn->disconnect();
		return $resp;
	}
	
	public function existCustomer(){
		$con= new Connection();
		$conectar=$con->connect();
		$sql= "SELECT * FROM tbl_customer WHERE txtDocument='".$this->txtDocument."'";
		$consul=$con->query($sql);
		$num_rows = mysql_num_rows($consul);
		$con->cleanQuery();
		$con->disconnect();
		return $num_rows;
	}
	
	function FindCustomer($select,$word){
		$con= new Connection();
		$conectar=$con->connect();
		if($select=='documento'){
			$sql = "SELECT * from tbl_customer WHERE txtDocument LIKE '%".$word."%'";
		}elseif($select=='nombre1'){
			$sql = "SELECT * from tbl_customer WHERE txtFirtsName LIKE '%".$word."%'";
		}elseif($select=='id'){
			$sql = "SELECT * from tbl_customer WHERE intId = '".$word."'";
		}else{
			$sql = "SELECT * from tbl_customer";
		}
		//echo "<BR>SQL: ".$sql;
		$customer = array();
		$cont = 0;
		$resp = $con->query($sql);
		while ($data = @mysql_fetch_array($resp)){
			$customer[$cont] = new Customer($data['intId'],$data['txtTypePerson'],$data['txtTypeDocument'],$data['txtDocument'],$data['txtFirtsName'],$data['txtSecondName'],$data['txtLastName'],$data['txtSecondLastName'],$data['txtaddress'],$data['txtCity'],$data['txtPhone'],$data['txtCelPhone'],$data['txtEmail'],$data['txtObservation'],$data['tmpDate'],$data['intState']);
			$cont++;
		}
		$con->cleanQuery();
		$con->disconnect();
		return $customer;
	}
	
	public function activateDesactivateCustomer($value){
		$con= new Connection();
		$conectar=$con->connect();
		$sql= 'UPDATE tbl_customer set intState="'.$value.'" where intId="'.$this->intId.'"';
		//echo $sql;
		$resp = $con->query($sql);;
		$con->cleanQuery();
		$con->disconnect();
		return $resp;
	}
}
?>