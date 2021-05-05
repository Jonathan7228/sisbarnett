<?php 
session_start();
if($_SESSION["profile"]=='1'  || $_SESSION["profile"]=='2'){

?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Seleccionar Busqueda</title>
		<link href="../css/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript" src="../js/validaciones.js" type="text/javascript"></script>
		</head>
		
<body>
<form action="" method="post" name="form1" id="form1" target="basefrm" enctype="multipart/form-data"  >
		<table width="228" height="62" border="0">
		  <tr>
			<td width="30" height="50"><a href="javascript:valcustomer('back')"><img src="../img/flecha.png" width="30" height="30" title="Regresar" /></a></td>
			<td width="30"><img src="../img/guardar_opaco.png" alt="Guardar" width="30" height="30" title="Guardar"  /></a></td>
			<td width="30"><img src="../img/activar_opaco.png" alt="Activar" width="30" height="30" title="Activar" /></td>
			<td width="30"><img src="../img/desactivar_opaco.png" alt="Desactivar" width="30" height="30" title="Desactivar" /></td>
			<td width="245"><a href="FindCustomer.php"><img src="../img/buscar_lupa.png" alt="Buscar" width="30" height="30" title="Buscar"  /></a></td>
		  </tr>
		</table>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
				<td width="819" height="132" align="center" valign="top">
				<table width="394" border="0" align="center" cellpadding="2" cellspacing="0" class="tablaformulario" >
				  <tr align="center">
					<td width="154" valign="middle">&nbsp;</td>
					<td width="1" valign="middle">&nbsp;</td>
					<td valign="middle">&nbsp;</td>
				  </tr>
				  <tr align="center" class="colorbarratitulos">
					<td colspan="3" valign="middle" class="tamcolorletratitulos">BUSCAR ORDEN DE PEDIDO POR:</td>
				  </tr>
				  <tr>
					<td align="center">&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td width="161" align="center">&nbsp;</td>
				  </tr>
				  <tr align="center">
					<td class="tamcolorletraformulario">Cliente</td>
					<td class="tamcolorletraformulario">&nbsp;</td>
					<td class="tamcolorletraformulario">Orden de Pedido</td>
				  </tr>
				  <tr align="center">
					<td class="tamcolorletraformulario"><a href="FindOrderbyCustomer.php"><img src="../img/boton_aceptar.png" width="83" height="35" /></a></td>
					<td class="tamcolorletraformulario">&nbsp;</td>
					<td class="tamcolorletraformulario"><a href="FindbyOrder.php"><img src="../img/boton_aceptar.png" alt="" width="83" height="35" /></a></td>
				  </tr>
					<tr>
							<td height="36" align="center">&nbsp;</td>
							<td height="36" align="center">&nbsp;</td>
							<td height="36" align="center">&nbsp;</td>
					</tr>
			    </table></td>
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