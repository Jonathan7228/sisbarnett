<?php
include_once '../classes/Order.php';
include_once '../classes/ProductOrder.php'; 
include_once '../classes/Product.php';
include_once '../classes/TmpProductOrder.php';
include_once '../classes/Customer.php';
include_once '../classes/LogOrder.php';

session_start();
if($_SESSION["profile"]=='1'  || $_SESSION["profile"]=='2'){
$date=date('Y-m-d');
$order = unserialize($_SESSION['order']);
		$customer = new Customer('','','','','','','','','','','','','','','','');
		$cus = $customer->FindCustomer('id',$order->intIdCustomer);
		$productOrder = new ProductOrder('','','','','');
		$productos = $productOrder->FindProductOrder('intIdOrder',$order->intId);


		if(!empty($_POST['action']) && $_POST['action'] == 'delete'){
			$eliminatelist = $tmpProductOrder->DeletedTmpProductOrder($_POST['id'],$customer->intId,$date);
			if($eliminatelist){
				echo '<script>window.location="CreateOrder.php";</script>';	
			} 
		}
		
		if(!empty($_POST['action']) and $_POST['action']=='activate'){
			$sta_order= new Order($order->intId,$order->intIdCustomer,$order->dbTotal,$order->txtObservation,$order->tmpDate,$order->intState);
			$state = $sta_order->activateDesactivateOrder('1');
			$order->intState="1";
			if($state){
				$log = new LogOrder('',$_SESSION["DocumentUser"],$_SESSION["NameUser"],$order->intId,'ACTIVACION ORDEN PEDIDO','');
				$savelog = $log->saveLogOrder();
				$_SESSION['order']=serialize($order);
				echo "<script>alert('La Orden ha sido activada correctamente');</script> ";
				echo '<script>window.location="EditViewOrder.php";</script>';
			}else{
				echo "<script>alert('La Orden no pudo ser activada, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditViewOrder.php";</script>';
			}
		}
		
		if(!empty($_POST['action']) and $_POST['action']=='desactivate'){
			$sta_order= new Order($order->intId,$order->intIdCustomer,$order->dbTotal,$order->txtObservation,$order->tmpDate,$order->intState);
			$state = $sta_order->activateDesactivateOrder('2');
			$order->intState="2";
			if($state){
				$log = new LogOrder('',$_SESSION["DocumentUser"],$_SESSION["NameUser"],$order->intId,'ANULACION ORDEN PEDIDO','');
				$savelog = $log->saveLogOrder();
				$_SESSION['order']=serialize($order);
				echo "<script>alert('La Orden ha sido anulada correctamente');</script> ";
				echo '<script>window.location="EditViewOrder.php";</script>';
			}else{
				echo "<script>alert('La Orden no pudo ser anulada, intentelo nuevamente');</script> ";
				echo '<script>window.location="EditViewOrder.php";</script>';
			}
		}
		
		
		
			if(!empty($_POST['action']) and $_POST['action']=='back'){
				echo '<script>window.location="../fondo_presentacion.php";</script>';
			}
			
			if(!empty($_POST['action']) and $_POST['action']=='pdf'){
				//include_once 'DownloadOrderPDF.php';
				echo '<a target="_blank" href="DownloadOrderPDFformac.php?id='.$order->intId.'">';
			}
		?>
		
		
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Orden Pedido</title>
		<link href="../css/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript" src="../js/validaciones.js" type="text/javascript"></script>
		<script> 
			var miPopup 
			function SelectProduct(intIdCustomer,tmpDate){ 
				miPopup = window.open("SelectProduct.php?intIdCustomer="+intIdCustomer+"&tmpDate="+tmpDate,"popup","width=800,height=500,menubar=no,toolbar=no,scrollbars=yes,directories=no,location=no") 
				miPopup.focus(); 
			}
		</script>

		</head>
		
<body>
		<form action="" method="post" name="form1" id="form1" target="basefrm" enctype="multipart/form-data">
		<table width="1000" border="0">
		  <tr align="left" valign="middle">
			<td><table width="175" height="62" border="0">
			  <tr>
				<td width="30" height="50"><a href="javascript:valorder('back')"><img src="../img/flecha.png" width="30" height="30" title="Regresar" /></a></td>
				<td width="30"><a href="javascript:valorder('save')"><img src="../img/guardar.png" width="30" height="30" title="Guardar"  /></a></td>
				 <td width="30">
				<?php 
                   if($order->intState == '2' && $_SESSION["profile"]=='1'){ ?>
                  	<a href="javascript:valorder('activate')"><img src="../img/activar.png" alt="activar" width="32" height="32" border="0" title="Activar"/></a>
                <?php 
                    }else{?>
                      <img src="../img/activar_opaco.png" alt="activar" width="32" height="32" border="0" title="Activar"/>
                <?php 
                    }
                ?>
           		</td>
           		<td width="30">
             	<?php 
                  if($order->intState == '1'  && $_SESSION["profile"]=='1'){ ?>
             		<a href="javascript:valorder('desactivate')"><img src="../img/desactivar.png" alt="desactivar" width="32" height="32" border="0" title="Desactivar" /></a>
             	<?php 
                    }else{?>
             		<img src="../img/desactivar_opaco.png" alt="desactivar" width="32" height="32" border="0" title="Desactivar" />
             	<?php 
                    }
                ?>
           </td>
           <?php 
                  if($order->intState == '1'  && $_SESSION["profile"]=='1'){ ?>
            <td width="33"><a target="_blank" href="DownloadOrderPDF.php?id=<?php echo $order->intId; ?>"><img src="../img/PDF_downlaod.png" width="30" height="30" title="Descargar PDF"  /></a></td>
       <?php 
                    }else{?>
             		<td width="33"><img src="../img/PDF_downlaod_opaco.png" width="30" height="30" title="Descargar PDF"  /></td>
             	<?php 
                    }
                ?>
       
       <td width="33"><a href="SelectFindOrder.php"><img src="../img/buscar_lupa.png" width="30" height="30" title="Buscar"  /></a></td>
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
				<table width="700" border="0" align="left" cellpadding="2" cellspacing="0" class="tablaformulario" >
				  <tr align="center">
					<td colspan="6" valign="middle">&nbsp;</td>
				  </tr>
				  <tr align="center" class="colorbarratitulos">
					<td colspan="6" valign="middle" class="tamcolorletratitulos">ORDEN DE PEDIDO</td>
				  </tr>
				  <tr>
					<td align="left" valign="middle">&nbsp;</td>
					<td width="106" align="center"><input name="action" type="hidden" id="action"/>
										<input name="id" type="hidden" id="id"/>
										<input name="view" type="hidden" id="view"/></td>
					<td width="180" align="center">&nbsp;</td>
					<td width="1" align="center">&nbsp;</td>
					<td width="75" align="center">&nbsp;</td>
					<td width="185" align="center">&nbsp;</td>
				  </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" class="tamcolorletraformulario">Numero Orden</td>
				    <td align="left" class="tamcolorletraformulario"><input type="text" name="txtNumOrder" id="txtNumOrder" title="Numero Orden de Pedido" value="<?php echo $order->intId; ?>" disabled="disabled" size="10" /></td>
				    <td align="left">&nbsp;</td>
				    <td align="left" class="tamcolorletraformulario">Estado</td>
				    <td align="left" class="tamcolorletraformulario"><input type="text" name="txtState" id="txtState" onkeypress="javascript:return Numeros(event)" title="Documento Cliente" value="<?php if($order->intState=='1'){ echo 'Activa'; }else{ echo 'Anulada'; } ?>" disabled="disabled" /></td>
			      </tr>
				  <tr>
					<td align="left" valign="middle">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario">Fecha</td>
					<td align="left" class="tamcolorletraformulario">
					  <input name="tmpDate" type="text"  id="tmpDate" title="Fecha" value="<?php echo $order->tmpDate; ?>" size="20" readonly="readonly" disabled="disabled" /></td>
					<td align="left">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario">Documento</td>
					<td align="left" class="tamcolorletraformulario">
                    <input type="text" name="txtDocument" id="txtDocument" onkeypress="javascript:return Numeros(event)" title="Documento Cliente" value="<?php echo $cus[0]->txtDocument; ?>" disabled="disabled" /></td>
				  </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" class="tamcolorletraformulario">Nombre Cliente</td>
				    <td colspan="4" align="left" class="tamcolorletraformulario">
                    <input name="txtName" type="text" id="txtName" class="campos_mayus" title="Nombre Cliente" size="50" value="<?php echo $cus[0]->txtFirtsName.' '.$cus[0]->txtSecondName.' '.$cus[0]->txtLastName.' '.$cus[0]->txtSecondLastName; ?>" disabled="disabled" /></td>
			      </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" class="tamcolorletraformulario">Email Cliente</td>
				    <td colspan="4" align="left" class="tamcolorletraformulario"><input name="txtEmail" type="text" id="txtEmail" title="Email del Cliente" size="50" value="<?php echo $cus[0]->txtEmail?>" disabled="disabled"/></td>
			      </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" class="tamcolorletraformulario">Observacion:</td>
				    <td colspan="4" align="left" class="tamcolorletraformulario">&nbsp;</td>
			      </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td colspan="5" align="left" class="tamcolorletraformulario"><textarea name="txtObservation" id="txtObservation" cols="70" rows="5" class="campos_mayus" title="Ingresa la Observacion" disabled="disabled"><?php echo $order->txtObservation; ?></textarea></td>
			      </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td colspan="5" align="left" class="tamcolorletraformulario">Seleccionar Producto: <img src="../img/buscar_opaco.png" width="20" height="20" /></td>
			      </tr>
				  <tr>
				    <td colspan="6" align="left" valign="middle">
				      
				      <?php 
					if(sizeof($productos)!=0){
			?>
				      <table width="680" border="1" align="center" cellpadding="0" cellspacing="0" class="tablaformulario">
				        <tr class="colorbarratitulos">
				          <td align="center" colspan="6" class="tamcolorletratitulos">PRODUCTOS SELECCIONADOS</td>
				          </tr>
				        <tr>
				          <td width="57" align="center">&nbsp;</td>
				          <td width="246">&nbsp;</td>
				          <td width="69" align="center" valign="middle">&nbsp;</td>
				          <td width="38" align="center" valign="middle">&nbsp;</td>
				          <td width="147" align="center" valign="middle">&nbsp;</td>
				          <td width="45" align="center" valign="middle">&nbsp;</td>
				          </tr>
				        <tr class="colorbarratitulos">
				          <td width="57" align="center" class="tamcolorletratitulostablaresul">Codigo</td>
				          <td width="246" align="center" class="tamcolorletratitulostablaresul">Descripcion</td>
				          <td width="69" align="center" class="tamcolorletratitulostablaresul">Valor</td>
				          <td width="38" align="center" class="tamcolorletratitulostablaresul">Cantidad</td>
				          <td width="147" align="center" class="tamcolorletratitulostablaresul">Subtotal</td>
				          <td width="45" align="center" class="tamcolorletratitulostablaresul">Quitar</td>
				          </tr>
				        <?php
									for ($i=0; $i<count($productos); $i++){
										$prodOrder = $productos[$i];
										$product = new Product('','','','','','','');
										$prod = $product->FindProduct('id',$prodOrder->intIdProduct);
										
									?>
				        <tr align="left" class="TablaUsuarios">
				          <td width="57" align="center" class="tamcolorletraformulario"><?php echo $prod[0]->txtCod; ?></td>
				          <td width="246" class="tamcolorletraformulario"><?php echo $prod[0]->txtDescription; ?></td>
				          <td width="69" class="tamcolorletraformulario"><?php echo $prod[0]->dbValue; ?></td>
				          <td align="center"><input name="intQuantity<?php echo $prod[0]->intId;  ?>" type="text" id="intQuantity<?php echo $prod[0]->intId;  ?>" onkeypress="javascript:return Numeros(event)" onchange="valSubtotal('<?php echo $prod[0]->intId; ?>','<?php echo $prod[0]->dbValue; ?>', this);" size="5" value="<?php echo $prodOrder->intQuantity; ?>" disabled="disabled" /></td>
				          <td width="147" align="center" valign="middle"><input name="subTotal<?php echo $prod[0]->intId;  ?>" type="text" id="subTotal<?php echo $prod[0]->intId;  ?>" size="8" readonly="readonly" value="<?php echo $prodOrder->dbSubtotal; ?>" disabled="disabled" /></td>
				          <td width="45" align="center" valign="middle"><img src="../img/desactivar_opaco.png" width="25" height="25" /></td>
				          
				          </tr>
				        <?php } ?>
				        <tr align="left" class="TablaUsuarios">
				          <td width="57" align="center" class="tamcolorletraformulario">&nbsp;</td>
				          <td width="246" class="tamcolorletraformulario">&nbsp;</td>
				          <td width="69" class="tamcolorletraformulario">&nbsp;</td>
				          <td align="center"><strong>TOTAL</strong></td>
				          <td width="147" align="center" valign="middle"><input name="Total" type="text" id="Total" size="8" readonly="readonly" value="<?php echo $order->dbTotal; ?>" disabled="disabled" /></td>
				          <td width="45" align="center" valign="middle">&nbsp;</td>
				          
			            </tr>
			          </table>
				      <?php
								}
							?>			        </td>
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