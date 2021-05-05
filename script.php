<?php

$con = mysql_connect('localhost', 'root', '');
mysql_select_db("db_sisbarnett", $con);
$cont=0;
$filas=file('customers.txt'); 
foreach($filas as $value){
list($txtTypePerson,$txtTypeDocument,$txtDocument,$txtFirtsName,$txtSecondName,$txtLastName,$txtSecondLastName,$txtaddress,$txtCity,$txtPhone,$txtCelPhone,$txtEmail,$txtObservation) = explode("|", $value);
$cont++;
//echo 'Cedula: '.$txtDocument.'<br/>'; 
//echo 'Nombre: '.$txtFirtsName.','.$txtSecondName.','.$txtLastName.','.$txtSecondLastName.'<br/>'; 
echo $cont.'<br>';

$insert = "INSERT INTO tbl_customer(txtTypePerson,txtTypeDocument,txtDocument,txtFirtsName,txtSecondName,txtLastName,txtSecondLastName,txtaddress,txtCity,txtPhone,txtCelPhone,txtEmail,txtObservation) VALUES ('".$txtTypePerson."','".$txtTypeDocument."','".$txtDocument."','".$txtFirtsName."','".$txtSecondName."','".$txtLastName."','".$txtSecondLastName."','".$txtaddress."','".$txtCity."','".$txtPhone."','".$txtCelPhone."','".$txtEmail."','".$txtObservation."')";
$resultado=mysql_query($insert, $con);
}
echo $cont.' Registros Insertados';
?>