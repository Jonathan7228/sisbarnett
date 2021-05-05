<?php 
include_once '../classes/Product.php';
include_once '../classes/LogProduct.php';
session_start();
$date=date('Y-m-d');

if($_SESSION["profile"]=='1'){		
		if(!empty($_POST['action']) && $_POST['action'] == 'save'){

			$_POST['txtDescription']=strtoupper($_POST['txtDescription']);
			$_POST['txtObservation']=strtoupper($_POST['txtObservation']);
			
			$product= new Product('',$_POST['txtCod'],$_POST['txtDescription'],$_POST['dbValue'],$_POST['txtObservation'],$date,'');
			$existProduct=$product->existProduct();
			if(!$existProduct){
				$id=$product->saveProduct();
				if($id){
					$log = new LogProduct('',$_SESSION["DocumentUser"],$_SESSION["NameUser"],$_POST['txtCod'],$_POST['txtDescription'],$_POST['dbValue'],'CREACION PRODUCTO','');
					$savelog = $log->saveLogProduct();
					echo "<script>alert ('El producto fue creado con exito');</script>";
					echo '<script>window.location="CreateProduct.php";</script>';
				}else{
					echo "<script>alert ('El producto no pudo ser creado, Intenta de nuevo');</script>";
					echo '<script>window.location="CreateProduct.php";</script>';
				}				
			}else{
				echo "<script>alert ('El producto ya existe, verifica por favor!');</script>";
				echo '<script>window.location="CreateProduct.php";</script>';
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
		<title>Crear Producto</title>
		<link href="../css/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript" src="../js/validaciones.js" type="text/javascript"></script>


		</head>
		
		<body>
		<form action="" method="post" name="form1" id="form1" target="basefrm" enctype="multipart/form-data">
		<table width="1000" border="0">
		  <tr align="left" valign="middle">
			<td><table width="175" height="62" border="0">
			  <tr>
				<td width="30" height="50"><a href="javascript:valproduct('back')"><img src="../img/flecha.png" width="30" height="30" title="Regresar" /></a></td>
				<td width="30"><a href="javascript:valproduct('save')"><img src="../img/guardar.png" width="30" height="30" title="Guardar"  /></a></td>
				<td width="30"><img src="../img/activar_opaco.png" width="30" height="29" title="Activar" /></td>
				<td width="30"><img src="../img/desactivar_opaco.png" width="30" height="29" title="Desactivar" /></td>
				<td width="33"><a href="FindProduct.php"><img src="../img/buscar_lupa.png" width="30" height="30" title="Buscar"  /></a></td>
			  </tr>
			</table></td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="center" valign="top"><table width="785" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
				<td width="759" height="132" align="left" valign="top">
				<table width="650" border="0" align="left" cellpadding="2" cellspacing="0" class="tablaformulario" >
				  <tr align="center">
					<td colspan="6" valign="middle">&nbsp;</td>
					</tr>
				  <tr align="center" class="colorbarratitulos">
					<td colspan="6" valign="middle" class="tamcolorletratitulos">CREAR PRODUCTO</td>
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
					  <input name="tmpDate" type="text"  id="tmpDate" title="Fecha" value="<?php echo $date; ?>" size="20" readonly="readonly" /></td>
					<td align="left">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario">Codigo</td>
					<td align="left" class="tamcolorletraformulario">*
                    <input type="text" name="txtCod" id="txtCod" onkeypress="javascript:return Numeros(event)" title="Ingresa el Codigo del Producto" /></td>
				  </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" class="tamcolorletraformulario">Descripcion</td>
				    <td colspan="4" align="left" class="tamcolorletraformulario">*
                    <input name="txtDescription" type="text" id="txtDescription" class="campos_mayus" title="Ingresa la descripcion del Producto" size="50" /></td>
			      </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" class="tamcolorletraformulario">Valor Unitario</td>
				    <td colspan="4" align="left" class="tamcolorletraformulario">*
                    <input name="dbValue" type="text" id="dbValue" onkeypress="javascript:return Numeros(event)" title="Ingresa el Valor del Producto" size="20" /></td>
			      </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" class="tamcolorletraformulario">Observacion:</td>
				    <td colspan="4" align="left" class="tamcolorletraformulario">&nbsp;</td>
			      </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td colspan="5" align="left" class="tamcolorletraformulario"><textarea name="txtObservation" id="txtObservation" cols="70" rows="10" class="campos_mayus" title="Ingresa la Observacion"></textarea></td>
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