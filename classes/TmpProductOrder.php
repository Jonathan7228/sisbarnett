<?php
include_once '../connection/Connection.php';
if(isset($_REQUEST["e"])){
			$tmporder = new TmpProductOrder('','','','','');
			$update = $tmporder->EditTmpProductOrder($_POST['quantity'],$_POST['id'],$_POST['valor']);
			
		}
class TmpProductOrder{
	
	public $intId;
	public $intIdCustomer;
	public $intIdProduct;
	public $intQuantity;
	public $intSubTotal;
	public $tmpDate;	
	
	
	function TmpProductOrder($intId="",$intIdCustomer="",$intIdProduct="",$intQuantity="",$intSubTotal="",$tmpDate=""){
			$this->intId = $intId;
			$this->intIdCustomer=$intIdCustomer;
			$this->intIdProduct=$intIdProduct;
			$this->intQuantity=$intQuantity;
			$this->intSubTotal=$intSubTotal;
			$this->tmpDate=$tmpDate;
		
	}
	
	function saveTmpProductOrder(){
		$conn = new Connection();
		$conn->connect();
		$sql = "INSERT INTO tbl_temp_prod_order (intIdCustomer,intIdProduct,intQuantity,intSubTotal,tmpDate) VALUES ('".$this->intIdCustomer."','".$this->intIdProduct."','".$this->intQuantity."','".$this->intSubTotal."','".$this->tmpDate."')";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->query($sql);
		$conn->cleanQuery();
		$conn->disconnect();
		return $resp;
	}
	
	function DeletedTmpProductOrder($idPro,$idCus,$tmpDate){
		$conn = new Connection();
		$conn->connect();
		$sql = "DELETE FROM tbl_temp_prod_order WHERE intIdCustomer =".$idCus." AND intIdProduct = ".$idPro." AND tmpDate='".$tmpDate."'";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->query($sql);
		$conn->cleanQuery();
		$conn->disconnect();
		return $resp;
	}
	
	function DeletedTmpProductOrderAll($idCus,$tmpDate){
		$conn = new Connection();
		$conn->connect();
		$sql = "DELETE FROM tbl_temp_prod_order WHERE intIdCustomer =".$idCus." AND tmpDate='".$tmpDate."'";
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->query($sql);
		$conn->cleanQuery();
		$conn->disconnect();
		return $resp;
	}
	
	function FindTmpProductOrder(){
		$con= new Connection();
		$conectar=$con->connect();
		$sql = "SELECT * FROM tbl_temp_prod_order WHERE intIdCustomer = '".$this->intIdCustomer."' AND tmpDate = '".$this->tmpDate."' ";
		//echo "<BR>SQL: ".$sql;
		$productOrder = array();
		$cont = 0;
		$resp = $con->query($sql);
		while ($data = @mysql_fetch_array($resp)){
			$productOrder[$cont] = new TmpProductOrder($data['intId'],$data['intIdCustomer'],$data['intIdProduct'],$data['intQuantity'],$data['intSubTotal'],$data['tmpDate']);
			$cont++;
		}
		$con->cleanQuery();
		$con->disconnect();
		return $productOrder;
	}
	
	public function EditTmpProductOrder($intQuantity,$intId,$valor){
		$subtotal = $valor * $intQuantity;
		$conn = new Connection();
		$conn->connect();
		$sql= 'UPDATE tbl_temp_prod_order set intQuantity="'.$intQuantity.'",intSubTotal="'.$subtotal.'" WHERE intIdProduct="'.$intId.'"';
		//echo $sql;
		$resp = $conn->query($sql);
		$conn->cleanQuery();
		$conn->disconnect();
		echo json_encode($intId);
	}

}
?>