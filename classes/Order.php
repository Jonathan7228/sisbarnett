<?php
include_once '../connection/Connection.php';

class Order{
	
	public $intId;
	public $intIdCustomer;
	public $dbTotal;
	public $txtObservation;
	public $tmpDate;
	public $intState;	
	
	function Order($intId="",$intIdCustomer="",$dbTotal="",$txtObservation="",$tmpDate="",$intState=""){
		$this->intId = $intId;
		$this->intIdCustomer=$intIdCustomer;
		$this->dbTotal=$dbTotal;
		$this->txtObservation=$txtObservation;
		$this->tmpDate=$tmpDate;
		$this->intState=$intState;
	}
	
	function saveOrder(){
		$conn = new Connection();
		$conn->connect();
		$sql = "INSERT INTO tbl_order (intIdCustomer,dbTotal,txtObservation) VALUES ('".$this->intIdCustomer."','".$this->dbTotal."','".$this->txtObservation."')";
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
	
	function FindOrder($select,$word){
		$con= new Connection();
		$conectar=$con->connect();
		if($select=='intIdCustomer'){
			$sql = "SELECT * from tbl_order WHERE intIdCustomer = '".$word."'";
		}elseif($select=='intId'){
			$sql = "SELECT * from tbl_order WHERE intId = '".$word."'";
		}elseif($select=='tmpDate'){
			$sql = "SELECT * from tbl_order WHERE DATE(tmpDate) = DATE('".$word."')";
		}else{
			$sql = "SELECT * from tbl_order";
		}
		//echo "<BR>SQL: ".$sql;
		$order = array();
		$cont = 0;
		$resp = $con->query($sql);
		while ($data = @mysql_fetch_array($resp)){
			$order[$cont] = new Order($data['intId'],$data['intIdCustomer'],$data['dbTotal'],$data['txtObservation'],$data['tmpDate'],$data['intState']);
			$cont++;
		}
		$con->cleanQuery();
		$con->disconnect();
		return $order;
	}
	
	public function activateDesactivateOrder($value){
		$con= new Connection();
		$conectar=$con->connect();
		$sql= 'UPDATE tbl_order set intState="'.$value.'" where intId="'.$this->intId.'"';
		//echo $sql;
		$resp = $con->query($sql);;
		$con->cleanQuery();
		$con->disconnect();
		return $resp;
	}
}
?>