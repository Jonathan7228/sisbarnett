<?php

$con = mysql_connect('localhost', 'root', '');
mysql_select_db("db_sisbarnett", $con);
$cont=0;
$filas=file('inventory.txt'); 
foreach($filas as $value){
list($txtCod,$intQuantity) = explode("|", $value);
$result = mysql_query("SELECT * from tbl_product WHERE txtCod = '".$txtCod."'",$con);
mysql_data_seek ($result, 0);
$extraido= mysql_fetch_array($result);
$cont++;
echo 'Id: '.$extraido['intId'].' - '; 
echo 'Codigo: '.$txtCod.' - '; 
echo 'Cantidad: '.$intQuantity.'<br>';

$insert = "INSERT INTO tbl_inventory(intIdProduct,intQuantity) VALUES ('".$extraido['intId']."','".$intQuantity."')";$resultado=mysql_query($insert, $con);
}
echo $cont.' Registros Insertados';
?>