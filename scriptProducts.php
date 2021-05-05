<?php

$con = mysql_connect('localhost', 'root', '');
mysql_select_db("db_sisbarnett", $con);
$cont=0;
$filas=file('products.txt'); 
foreach($filas as $value){
list($txtCod,$txtDescription,$dbValue,$txtObservation) = explode("|", $value);
$cont++;
//echo 'Cedula: '.$txtDocument.'<br/>'; 
//echo 'Nombre: '.$txtFirtsName.','.$txtSecondName.','.$txtLastName.','.$txtSecondLastName.'<br/>'; 
//echo $cont.'<br>';

$insert = "INSERT INTO tbl_product(txtCod,txtDescription,dbValue,txtObservation) VALUES ('".$txtCod."','".$txtDescription."','".$dbValue."','".$txtObservation."')";$resultado=mysql_query($insert, $con);
}
echo $cont.' Registros Insertados';
?>
