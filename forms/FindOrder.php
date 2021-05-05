<?php 
session_start();
if($_SESSION["profile"]=='1' || $_SESSION["profile"]=='2'){
include_once '../classes/Order.php';
include_once '../classes/Customer.php';
include_once '../classes/Product.php';
include_once '../classes/ProductOrder.php';

		if($_SESSION['typefind']==1){
			$customer = unserialize($_SESSION['customer']);
			$order= new Order('','','','','','');
			$resp=$order->FindOrder('intIdCustomer',$customer->intId);
			$_SESSION['orders'] = serialize($resp);	
		}		
			
			
			if(!empty($_POST['action']) && $_POST['action'] == 'edit'){
				$orders=unserialize($_SESSION['orders']);
				if($_POST['view']=='1'){
					$_SESSION['view']='1';
				}else{
					$_SESSION['view']='2';
				}
				for($i=0; $i<count($orders); $i++){
					$order = $orders[$i];
					if($order->intId==$_POST['id']){
						$_SESSION['order']=serialize($order);
						unset($_SESSION['orders']);
						echo "<script> window.location.href='EditViewOrder.php';</script>";
					}
				}
			 }
			 if(!empty($_POST['action']) && $_POST['action'] == 'exportar'){
				include '../informes/excel_personal.php';
			}
			
			if(!empty($_POST['action']) and $_POST['action']=='back'){
				unset($_SESSION['orde']);
				unset($_SESSION['ordes']);
				unset($_SESSION['customer']);
				unset($_SESSION['customers']);
				echo '<script>window.location="../fondo_presentacion.php";</script>';
			}
		
		?>
		
		
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Buscar Orden de Pedido</title>
		<link href="../css/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript" src="../js/validaciones.js" type="text/javascript"></script>
		</head>
		
		<body onload="document.form1.nombre.focus( )">
		<form action="" method="post" name="form1" id="form1" target="basefrm" enctype="multipart/form-data"  >
		<table width="228" height="62" border="0">
		  <tr>
			<td width="30" height="50"><a href="javascript:valorder('back')"><img src="../img/flecha.png" width="30" height="30" title="Regresar" /></a></td>
			<td width="30"><img src="../img/guardar_opaco.png" alt="Guardar" width="30" height="30" title="Guardar"  /></a></td>
			<td width="30"><img src="../img/activar_opaco.png" alt="Activar" width="30" height="30" title="Activar" /></td>
			<td width="30"><img src="../img/desactivar_opaco.png" alt="Desactivar" width="30" height="30" title="Desactivar" /></td>
			<td width="245"><a href="SelectFindOrder.php"><img src="../img/buscar_lupa.png" alt="Buscar" width="30" height="30" title="Buscar"  /></a></td>
		  </tr>
		</table>
		
		<?php 
			if(sizeof($resp)!=0){
			?>
			<table width="800" border="1" align="center" cellpadding="0" cellspacing="0" class="tablaformulario">
								  <tr class="colorbarratitulos">
									<td colspan="6" align="center" class="tamcolorletratitulos">REGISTROS ENCONTRADOS</td>
								  </tr>
								  <tr>
									<td width="83" align="center">
										<input name="action" type="hidden" id="action"/>
										<input name="id" type="hidden" id="id"/>
										<input name="view" type="hidden" id="view"/>
										</td>
									<td width="121">&nbsp;</td>
									<td width="242" align="center" valign="middle">&nbsp;</td>
									<td width="208" align="center" valign="middle">&nbsp;</td>
									<td width="73" align="center" valign="middle">&nbsp;</td>
                                    <td width="59" align="center" valign="middle">&nbsp;</td>
								  </tr>
								  <tr class="colorbarratitulos">
									<td width="83" align="center" class="tamcolorletratitulostablaresul">Num O.P</td>
									<td width="121" align="center" class="tamcolorletratitulostablaresul">Doc Cliente</td>
									<td width="242" align="center" class="tamcolorletratitulostablaresul">Nombre Cliente</td>
                                    <td width="208" align="center" class="tamcolorletratitulostablaresul">Fecha</td>
                                    <td width="73" align="center" class="tamcolorletratitulostablaresul">Estado</td>
									<td width="59" align="center" class="tamcolorletratitulostablaresul">Ver</td>
								  </tr>
								  <?php
									for ($i=0; $i<count($resp); $i++){
										$op = $resp[$i];
									?>
									<tr align="left" class="TablaUsuarios">
										<td width="83" align="center"><?php echo ($op->intId); ?></td>
                                        <td width="121"><?php echo ($customer->txtDocument); ?></td>
										<td width="242"><?php echo ($customer->txtFirtsName.' '.$customer->txtSecondName.' '.$customer->txtLastName.' '.$customer->txtSecondLastName); ?></td>
                                        <td width="208"><?php echo ($op->tmpDate); ?></td>
										<td width="73" align="center" valign="middle"><?php if($op->intState==1){echo "ACTIVA";}else{echo "ANULADA";} ?></td>
										<td width="59" align="center" valign="middle"><a href="javascript:send_form_edit('edit','<?php echo $op->intId; ?>','0')" title="Editar Informacion"><img src="../img/seleccionar.png" width="25" height="25" /><a></td>
                                        
                                  </tr>
								<?php } ?>
					  </table>
					  <?php
								}else{
									
									echo "<script>alert ('No se encontro informacion, verifica por favor!');</script>";
									echo "<script> window.location.href='FindOrder.php';</script>";
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