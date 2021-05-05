<?php 
session_start();
if($_SESSION["profile"]=='1'){
include_once '../classes/Product.php';

			$view_product = 0;
		
			if(!empty ($_POST['select']) and $_POST['select'] == "*"){
				$_POST['word'] = "*";
			 }
			if(!empty($_POST['select']) && !empty($_POST['word'])){
				$product= new Product('','','','','','');
				$resp=$product->FindProduct($_POST['select'],$_POST['word']);
				$_SESSION['products'] = serialize($resp);
				$view_product = 1;
			}
			
			if(!empty($_POST['action']) && $_POST['action'] == 'sel'){
				$products=unserialize($_SESSION['products']);
				for($i=0; $i<count($products); $i++){
					$product = $products[$i];
					if($product->intId==$_POST['id']){
						$_SESSION['product']=serialize($product);
						unset($_SESSION['products']);
						echo "<script> window.location.href='AddInventory.php';</script>";
					}
				}
			 }
			 if(!empty($_POST['action']) && $_POST['action'] == 'exportar'){
				include '../informes/excel_personal.php';
			}
			
			if(!empty($_POST['action']) and $_POST['action']=='back'){
				unset($_SESSION['product']);
				unset($_SESSION['products']);
				echo '<script>window.location="../fondo_presentacion.php";</script>';
			}
		
		?>
		
		
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Buscar Producto</title>
		<link href="../css/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript" src="../js/validaciones.js" type="text/javascript"></script>
		</head>
		
<body onload="document.form1.nombre.focus( )">
		<form action="" method="post" name="form1" id="form1" target="basefrm" enctype="multipart/form-data"  >
		<table width="228" height="62" border="0">
		  <tr>
			<td width="30" height="50"><a href="javascript:valproduct('back')"><img src="../img/flecha.png" width="30" height="30" title="Regresar" /></a></td>
			<td width="30"><img src="../img/guardar_opaco.png" alt="Guardar" width="30" height="30" title="Guardar"  /></a></td>
			<td width="30"><img src="../img/activar_opaco.png" alt="Activar" width="30" height="30" title="Activar" /></td>
			<td width="30"><img src="../img/desactivar_opaco.png" alt="Desactivar" width="30" height="30" title="Desactivar" /></td>
			<td width="245"><a href="FindProduct.php"><img src="../img/buscar_lupa.png" alt="Buscar" width="30" height="30" title="Buscar"  /></a></td>
		  </tr>
		</table>
		<?php if($view_product == 0){?>
		<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
				<td width="819" height="132" align="center" valign="top">
				<table width="491" border="0" align="center" cellpadding="2" cellspacing="0" class="tablaformulario" >
				  <tr align="center">
					<td colspan="4" valign="middle">&nbsp;</td>
				  </tr>
				  <tr align="center" class="colorbarratitulos">
					<td colspan="4" valign="middle" class="tamcolorletratitulos">SELECCIONAR PRODUCTO INVENTARIO</td>
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
								<option value="txtCod">Codigo</option>
								<option value="txtDescription">Descripcion</option>
								<option value="*">Todos</option>
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
			<table width="800" border="1" align="center" cellpadding="0" cellspacing="0" class="tablaformulario">
								  <tr class="colorbarratitulos">
									<td colspan="5" align="center" class="tamcolorletratitulos">REGISTROS ENCONTRADOS</td>
								  </tr>
								  <tr>
									<td width="71" align="center">
										<input name="action" type="hidden" id="action"/>
										<input name="id" type="hidden" id="id"/>
										<input name="view" type="hidden" id="view"/>
									</td>
									<td width="234">&nbsp;</td>
									<td width="321" align="center" valign="middle">&nbsp;</td>
									<td width="63" align="center" valign="middle">&nbsp;</td>
									<td width="49" align="center" valign="middle">&nbsp;</td>
								  </tr>
								  <tr class="colorbarratitulos">
									<td width="71" align="center" class="tamcolorletratitulostablaresul">Codigo</td>
									<td width="234" align="center" class="tamcolorletratitulostablaresul">Descripcion</td>
									<td width="321" align="center" class="tamcolorletratitulostablaresul">Observacion</td>
									<td width="63" align="center" class="tamcolorletratitulostablaresul">Estado</td>
									<td width="48" align="center" class="tamcolorletratitulostablaresul">Seleccionar</td>
								  </tr>
								  <?php
									for ($i=0; $i<count($resp); $i++){
										$prod = $resp[$i];
									?>
									<tr align="left" class="TablaUsuarios">
										<td width="71" align="center"><?php echo $prod->txtCod; ?></td>
										<td width="234"><?php echo $prod->txtDescription; ?></td>
                                        <td width="321"><?php echo $prod->txtObservation; ?></td>
										<td width="63" align="center" valign="middle"><?php if($prod->intState==1){echo "ACTIVO";}else{echo "INACTIVO";} ?></td>
										<td width="48" align="center" valign="middle"><a href="javascript:send_form_edit('sel','<?php echo $prod->intId; ?>','0')" title="Editar Informacion"><img src="../img/seleccionar.png" width="30" height="30" /><a></td>
                                        
                                  </tr>
								<?php } ?>
		  </table>
					  <?php
								}else{
									$view_product = 0;
									echo "<script>alert ('No se encontro informacion, verifica por favor!');</script>";
									echo "<script> window.location.href='FindProduct.php';</script>";
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