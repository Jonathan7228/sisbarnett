<?php 
include_once '../classes/Product.php';
include_once '../classes/LogProduct.php';
session_start();
if($_SESSION["profile"]=='1'){
$date=date('Y-m-d');
$product = unserialize($_SESSION['product']);
		
		if(!empty($_POST['action']) && $_POST['action'] == 'edit'){

			$_POST['txtDescription']=strtoupper($_POST['txtDescription']);
			$_POST['txtObservation']=strtoupper($_POST['txtObservation']);
			
			$product= new Product($product->intId,$product->txtCod,$_POST['txtDescription'],$_POST['dbValue'],$_POST['txtObservation'],$date,'');
				$save=$product->editProduct();
				if($save){
					$log = new LogProduct('',$_SESSION["DocumentUser"],$_SESSION["NameUser"],$product->txtCod,$_POST['txtDescription'],$_POST['dbValue'],'EDICION PRODUCTO','');
					$savelog = $log->saveLogProduct();
					echo "<script>alert ('El producto fue editado con exito');</script>";
					echo '<script>window.location="FindProduct.php";</script>';
				}else{
					echo "<script>alert ('El producto no pudo ser editado, Intenta de nuevo');</script>";
					echo '<script>window.location="FindProduct.php";</script>';
				}				
		}
		
		if(!empty($_POST['action']) and $_POST['action']=='activate'){
			$sta_prod= new Product($product->intId,$product->txtCod,$product->txtDescription,$product->dbValue,$product->txtObservation,$product->tmpDate,$product->intState);
			$state = $sta_prod->activateDesactivateProduct('1');
			$product->intState="1";
			$_SESSION['view']='2';
			if($state){
				$log = new LogProduct('',$_SESSION["DocumentUser"],$_SESSION["NameUser"],$product->txtCod,$product->txtDescription,$product->dbValue,'ACTIVACION PRODUCTO','');
				$savelog = $log->saveLogProduct();
				$_SESSION['product']=serialize($product);
				echo "<script>alert('El Producto ha sido activado correctamente');</script> ";
				echo '<script>window.location="EditViewProduct.php";</script>';
			}else{
				echo "<script>alert('El Cliente no pudo ser activado, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditViewProduct.php";</script>';
			}
		}
	
	if(!empty($_POST['action']) and $_POST['action']=='desactivate'){
		$sta_prod= new Product($product->intId,$product->txtCod,$product->txtDescription,$product->dbValue,$product->txtObservation,$product->tmpDate,$product->intState);
		$state = $sta_prod->activateDesactivateProduct('2');
		$product->intState="2";
		$_SESSION['view']='2';
		if($state){
			$log = new LogProduct('',$_SESSION["DocumentUser"],$_SESSION["NameUser"],$product->txtCod,$product->txtDescription,$product->dbValue,'DESACTIVACION PRODUCTO','');
			$savelog = $log->saveLogProduct();
			$_SESSION['product']=serialize($product);
			echo "<script>alert('El Producto ha sido desactivado Correctamente');</script> ";
			echo '<script>window.location="EditViewProduct.php";</script>';
		}else{
			echo "<script>alert('El Producto no pudo ser desactivado, intentelo nuevamente');</script> ";
			echo '<script>window.location="EditViewProduct.php";</script>';
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
		<title>Editar Producto</title>
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
				<td width="30">
       		<?php 
				if($_SESSION['view']=='2' && $product->intState == 1){?>
       				<a href="javascript:valproduct('edit')"><img src="../img/guardar.png" width="30" height="30" title="Guardar"  /></a>
        	<?php 
				}else{?>
                    <img src="../img/guardar_opaco.png" width="30" height="30" title="Guardar"  />
			<?php 
				}
			?>
            </td>
         <td width="30">
			<?php 
				if($_SESSION['view']=='2' && $product->intState == 2){?>
              <a href="javascript:valproduct('activate')"><img src="../img/activar.png" alt="activar" width="32" height="32" border="0" title="Activar"/></a>
            <?php 
				}else{?>
                  <img src="../img/activar_opaco.png" alt="activar" width="32" height="32" border="0" title="Activar"/>
            <?php 
				}
			?>
       </td>
       <td width="30">
         <?php 
				if($_SESSION['view']=='2' && $product->intState == 1){?>
         <a href="javascript:valproduct('desactivate')"><img src="../img/desactivar.png" alt="desactivar" width="32" height="32" border="0" title="Desactivar" /></a>
         <?php 
				}else{?>
         <img src="../img/desactivar_opaco.png" alt="desactivar" width="32" height="32" border="0" title="Desactivar" />
         <?php 
				}
			?>
       </td>
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
					<td align="left" class="tamcolorletraformulario">Fecha Creacion</td>
					<td align="left" class="tamcolorletraformulario">*
					  <input name="tmpDate" type="text"  id="tmpDate" title="Fecha" value="<?php echo $product->tmpDate; ?>" size="20" readonly="readonly"   <?php if($product->intState == 2 || $_SESSION['view']=='1'){ echo 'disabled="disabled"';}?>/></td>
					<td align="left">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario">Codigo</td>
					<td align="left" class="tamcolorletraformulario">*
                    <input type="text" name="txtCod" id="txtCod" onkeypress="javascript:return Numeros(event)" title="Ingresa el Codigo del Producto" value="<?php echo $product->txtCod; ?>" disabled="disabled" <?php if($product->intState == 2 || $_SESSION['view']=='1'){ echo 'disabled="disabled"';}?> /></td>
				  </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" class="tamcolorletraformulario">Descripcion</td>
				    <td colspan="4" align="left" class="tamcolorletraformulario">*
                    <input name="txtDescription" type="text" id="txtDescription" class="campos_mayus" title="Ingresa la Descripcion del Producto" size="50" value="<?php echo $product->txtDescription; ?>" <?php if($product->intState == 2 || $_SESSION['view']=='1'){ echo 'disabled="disabled"';}?> /></td>
			      </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" class="tamcolorletraformulario">Valor Unitario</td>
				    <td colspan="4" align="left" class="tamcolorletraformulario">*
                    <input name="dbValue" type="text" id="dbValue" onkeypress="javascript:return Numeros(event)" title="Ingresa el Valor del Producto" size="20" value="<?php echo $product->dbValue; ?>" <?php if($product->intState == 2 || $_SESSION['view']=='1'){ echo 'disabled="disabled"';}?> /></td>
			      </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" class="tamcolorletraformulario">Observacion:</td>
				    <td colspan="4" align="left" class="tamcolorletraformulario">&nbsp;</td>
			      </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td colspan="5" align="left" class="tamcolorletraformulario"><textarea name="txtObservation" id="txtObservation" cols="70" rows="10" class="campos_mayus" title="Ingresa la Observacion" <?php if($product->intState == 2 || $_SESSION['view']=='1'){ echo 'disabled="disabled"';}?>><?php echo $product->txtObservation; ?></textarea></td>
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