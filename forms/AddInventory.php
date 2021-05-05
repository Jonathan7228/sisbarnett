<?php 
error_reporting(0);
include_once '../classes/Inventory.php';
include_once '../classes/Product.php';
include_once '../classes/LogInventory.php';
session_start();
if($_SESSION["profile"]=='1'){
$date=date('Y-m-d');
$product = unserialize($_SESSION['product']);
	$inventory= new Inventory('',$product->intId,'','');
	$data = $inventory->FindProductInventory();
	
		
		if(!empty($_POST['action']) && $_POST['action'] == 'save'){
			$inventory= new Inventory('',$product->intId,$_POST['intQuantity'],$date);
			if(!empty($data[0]->intQuantity)||$data[0]->intQuantity=='0'){
				$id=$inventory->editInventory();
			}else{
				$id=$inventory->addInventory();	
			}
			if($id){
				$log = new LogInventory('',$_SESSION["DocumentUser"],$_SESSION["NameUser"],$product->txtCod,$product->txtDescription,$_POST['intQuantity'],$date);
				$savelog = $log->saveLogInventory();
				echo "<script>alert ('El Inventario fue actualizado con exito');</script>";
				echo '<script>window.location="FindProductInventory.php";</script>';
			}else{
				echo "<script>alert ('El Inventario no pudo ser actualizado, Intenta de nuevo');</script>";
				echo '<script>window.location="FindProductInventory.php";</script>';
			}				
		}
			if(!empty($_POST['action']) and $_POST['action']=='back'){
				echo '<script>window.location="../fondo_presentacion.php";</script>';
			}
		?>
		
		
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Inventario</title>
		<link href="../css/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript" src="../js/validaciones.js" type="text/javascript"></script>


		</head>
		
		<body>
		<form action="" method="post" name="form1" id="form1" target="basefrm" enctype="multipart/form-data">
		<table width="1000" border="0">
		  <tr align="left" valign="middle">
			<td><table width="175" height="62" border="0">
			  <tr>
				<td width="30" height="50"><a href="javascript:valinventory('back')"><img src="../img/flecha.png" width="30" height="30" title="Regresar" /></a></td>
				<td width="30"><a href="javascript:valinventory('save')"><img src="../img/guardar.png" width="30" height="30" title="Guardar"  /></a></td>
				<td width="30"><img src="../img/activar_opaco.png" width="30" height="29" title="Activar" /></td>
				<td width="30"><img src="../img/desactivar_opaco.png" width="30" height="29" title="Desactivar" /></td>
				<td width="33"><a href="FindProductInventory.php"><img src="../img/buscar_lupa.png" width="30" height="30" title="Buscar"  /></a></td>
			  </tr>
			</table></td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="center" valign="top"><table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
				<td width="759" height="132" align="left" valign="top">
				<table width="650" border="0" align="left" cellpadding="2" cellspacing="0" class="tablaformulario" >
				  <tr align="center">
					<td colspan="6" valign="middle">&nbsp;</td>
					</tr>
				  <tr align="center" class="colorbarratitulos">
					<td colspan="6" valign="middle" class="tamcolorletratitulos">INSERTAR INVENTARIO</td>
					</tr>
				  <tr>
					<td align="left" valign="middle">&nbsp;</td>
					<td width="97" align="center"><input name="action" type="hidden" id="action" /></td>
					<td width="184" align="center">&nbsp;</td>
					<td width="1" align="center">&nbsp;</td>
					<td width="53" align="center">&nbsp;</td>
					<td width="162" align="center">&nbsp;</td>
					</tr>
				  <tr>
					<td align="left" valign="middle">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario">Fecha</td>
					<td align="left" class="tamcolorletraformulario">*
					  <input name="tmpDate" type="text"  id="tmpDate" title="Fecha" value="<?php echo $date; ?>" size="20" readonly="readonly" value="<?php echo $date; ?>" /></td>
					<td align="left">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario">Codigo</td>
					<td align="left" class="tamcolorletraformulario">*
                    <input type="text" name="txtCod" id="txtCod" onkeypress="javascript:return Numeros(event)" title="Ingresa el Codigo del Producto" readonly="readonly" value="<?php echo $product->txtCod; ?>" /></td>
				  </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" class="tamcolorletraformulario">Descripcion</td>
				    <td colspan="4" align="left" class="tamcolorletraformulario">*
                    <input name="txtDescription" type="text" id="txtDescription" class="campos_mayus" title="Ingresa la descripcion del Producto" size="50" readonly="readonly" value="<?php echo $product->txtDescription; ?>" /></td>
			      </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" class="tamcolorletraformulario">Cantidad</td>
				    <td colspan="4" align="left" class="tamcolorletraformulario">*
                    <input name="intQuantity" type="text" id="intQuantity" onkeypress="javascript:return Numeros(event)" title="Ingresa la Cantidad en Inventario" size="20" <?php if(!empty($data[0]->intQuantity)){ echo 'value="'.$data[0]->intQuantity.'"';} ?> /></td>
			      </tr>
				  <tr>
					<td width="3" align="left" valign="middle">&nbsp;</td>
					<td colspan="5" align="left" class="tamcolorletraformulario">&nbsp;</td>
				  </tr>
					</table>
					</td>
			  </tr>
			  
			</table></td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		</table>
		</form>
		</body>
		</html>
        <?php 
			}else{
				echo "<script>alert ('Este usuario no tiene autorizacion para ingresar a este modulo!');</script>";
				echo '<script>window.location="../fondo_presentacion.php";</script>';
			}
		?>
