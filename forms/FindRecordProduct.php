<?php 
session_start();
if($_SESSION["profile"]=='1'){
include_once '../classes/Customer.php';
include_once '../classes/LogProduct.php';

			$view_log = 0;		
			if(!empty($_POST['select']) && !empty($_POST['word'])){				
				$log= new LogProduct('','','','','','','','');
				$resp=$log->FindLogProduct($_POST['select'],$_POST['word']);
				$_SESSION['logs'] = serialize($resp);
				$view_log = 1;
			}
			
			if(!empty($_POST['action']) and $_POST['action']=='back'){
				unset($_SESSION['log']);
				unset($_SESSION['logs']);
				echo '<script>window.location="../fondo_presentacion.php";</script>';
			}
		
		?>
		
		
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Consultar Registro Productos</title>
		<link href="../css/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript" src="../js/validaciones.js" type="text/javascript"></script>
		</head>
		
<body>
		<form action="" method="post" name="form1" id="form1" target="basefrm" enctype="multipart/form-data"  >
		<table width="228" height="62" border="0">
		  <tr>
			<td width="30" height="50"><a href="javascript:valproduct('back')"><img src="../img/flecha.png" width="30" height="30" title="Regresar" /></a></td>
			<td width="30"><img src="../img/guardar_opaco.png" alt="Guardar" width="30" height="30" title="Guardar"  /></a></td>
			<td width="30"><img src="../img/activar_opaco.png" alt="Activar" width="30" height="30" title="Activar" /></td>
			<td width="30"><img src="../img/desactivar_opaco.png" alt="Desactivar" width="30" height="30" title="Desactivar" /></td>
			<td width="245"><a href="FindRecordProduct.php"><img src="../img/buscar_lupa.png" alt="Buscar" width="30" height="30" title="Buscar"  /></a></td>
		  </tr>
		</table>
		<?php if($view_log == 0){?>
		<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
				<td width="819" height="132" align="center" valign="top">
				<table width="491" border="0" align="center" cellpadding="2" cellspacing="0" class="tablaformulario" >
				  <tr align="center">
					<td colspan="4" valign="middle">&nbsp;</td>
				  </tr>
				  <tr align="center" class="colorbarratitulos">
					<td colspan="4" valign="middle" class="tamcolorletratitulos">CONSULTAR REGISTRO PRODUCTO</td>
				  </tr>
				  <tr>
					<td align="left" valign="middle">&nbsp;</td>
					<td colspan="2" align="center">&nbsp;</td>
					<td width="239" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td width="23" align="left" valign="middle">&nbsp;</td>
					<td colspan="2" align="left" class="tamcolorletraformulario">Criterio de Busqueda</td>
					<td align="left" class="tamcolorletraformulario">*		<select name="select" id="select" style="height: 20px; width: 150px;" onchange="valcampobusqueda(this.value,'');">
                                <option value="txtCod">Codigo Producto</option>
								<option value="txtNameProduct">Description Producto</option>
								<option value="tmpDate">Fecha</option>
							  </select>
					  <input name="action" type="hidden" id="action" /></td>
				  </tr>
				  <tr>
					<td align="right" valign="middle">&nbsp;</td>

					<td colspan="2" align="left" class="tamcolorletraformulario">Informacion a Buscar</td>
					<td align="left" class="tamcolorletraformulario">*	<input name="word" type="text" id="word" size="30" maxlength="50" class="campos_mayus" title="Ingresa el filtro de busqueda"/></td>
				  </tr>
					<tr>
							<td height="58" colspan="4" align="center"><a href="javascript:valcampobusqueda('1','buscar')"><img src="../img/boton_buscar.png" width="80" height="30" /></a></td>
					</tr>
				  <tr>
					<td align="center" valign="middle">&nbsp;</td>
					<td width="30" align="left">&nbsp;</td>
					<td width="113" align="left">&nbsp;</td>
					<td align="left">&nbsp;</td>
				  </tr>
				  </table></td>
			  </tr>
		  </table>
		
		<?php }else{
					if(sizeof($resp)!=0){
			?>
			<table width="900" border="1" align="center" cellpadding="0" cellspacing="0" class="tablaformulario">
								  <tr class="colorbarratitulos">
									<td colspan="6" align="center" class="tamcolorletratitulos">REGISTROS ENCONTRADOS</td>
								  </tr>
								  <tr>
									<td width="80" align="center">
										<input name="action" type="hidden" id="action"/>
										<input name="id" type="hidden" id="id"/>
										<input name="view" type="hidden" id="view"/>
									</td>
									<td width="192">&nbsp;</td>
									<td width="102" align="center" valign="middle">&nbsp;</td>
									<td width="237" align="center" valign="middle">&nbsp;</td>
									<td width="136" align="center" valign="middle">&nbsp;</td>
                                    <td width="139" align="center" valign="middle">&nbsp;</td>
								  </tr>
								  <tr class="colorbarratitulos">
									<td width="80" align="center" class="tamcolorletratitulostablaresul">Doc Usu.</td>
									<td width="192" align="center" class="tamcolorletratitulostablaresul">Nombre Usuario</td>
                                    <td width="102" align="center" class="tamcolorletratitulostablaresul">Cod. Producto</td>
									<td width="237" align="center" class="tamcolorletratitulostablaresul">Desc. Producto</td>
									<td width="136" align="center" class="tamcolorletratitulostablaresul">Descripcion</td>
                                    <td width="139" align="center" class="tamcolorletratitulostablaresul">Fecha</td>
								  </tr>
								  <?php
									for ($i=0; $i<count($resp); $i++){
										$logProd= $resp[$i];
									?>
									<tr align="left" class="TablaUsuarios">
										<td width="80"><?php echo $logProd->txtDocumentUser; ?></td>
										<td width="192"><?php echo $logProd->txtNameUser; ?></td>
                                        <td width="102"><?php echo $logProd->txtCod; ?></td>
                                        <td width="237"><?php echo $logProd->txtNameProduct; ?></td>
                                        <td width="136"><?php echo $logProd->txtDescription; ?></td>
                                        <td width="139"><?php echo $logProd->tmpDate; ?></td>
                                        
                                  </tr>
								<?php } ?>
		  </table>
					  <?php
								}else{
									$view_log = 0;
									echo "<script>alert ('No se encontro informacion, verifica por favor!');</script>";
									echo "<script> window.location.href='FindRecordProduct.php';</script>";
								}
							}
								?>
		</form>
</body>
		</html>


 		<?php 
			}else{
				echo "<script>alert ('Este usuario no tiene autorizacion para ingresar a este modulo!');</script>";
				echo '<script>window.location="../fondo_presentacion.php";</script>';
			}
		?>