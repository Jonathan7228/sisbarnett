<?php
include_once '../classes/Order.php';
include_once '../classes/ProductOrder.php'; 
include_once '../classes/Product.php';
include_once '../classes/TmpProductOrder.php';
include_once '../classes/Customer.php';
include_once '../classes/Inventory.php';
include_once '../classes/LogOrder.php';

session_start();
if($_SESSION["profile"]=='1'  || $_SESSION["profile"]=='2'){
			$date=date('Y-m-d');
			$customer = unserialize($_SESSION['customer']);
			$tmpProductOrder= new TmpProductOrder('',$customer->intId,'','','',$date);
			$resp=$tmpProductOrder->FindTmpProductOrder();

		if(!empty($_POST['action']) && $_POST['action'] == 'delete'){
			$eliminatelist = $tmpProductOrder->DeletedTmpProductOrder($_POST['id'],$customer->intId,$date);
			if($eliminatelist){
				echo '<script>window.location="CreateOrder.php";</script>';	
			} 
		}
		
		if(!empty($_POST['action']) && $_POST['action'] == 'save'){

			$_POST['txtObservation']=strtoupper($_POST['txtObservation']);
			
			$order= new Order('',$customer->intId,$_POST['Total'],$_POST['txtObservation'],'','');
			$id=$order->saveOrder();
			if($id){
				for ($i=0; $i<count($resp); $i++){
					$tmpprod = $resp[$i];
					$product = new Product('','','','','','','');
					$prod = $product->FindProduct('id',$tmpprod->intIdProduct);
					$productsOrder = new ProductOrder('',$id,$prod[0]->intId,$_POST['intQuantity'.$prod[0]->intId],$_POST['subTotal'.$prod[0]->intId]);
					$save = $productsOrder->saveProductOrder();
					$inventory = new Inventory('',$prod[0]->intId,$_POST['intQuantity'.$prod[0]->intId],'');
					$restInventory = $inventory->subtractInventory();
					
				}
					$log = new LogOrder('',$_SESSION["DocumentUser"],$_SESSION["NameUser"],$id,'CREACION ORDEN PEDIDO','');
					$savelog = $log->saveLogOrder();

			
				/* // Varios destinatarios
				$para  = 'jonathanbm88@hotmail.com'; // atención a la coma
				//$para .= 'wez@example.com';
				
				// título
				$título = 'Orden de Pedido Número'.$id;
				
				// mensaje
				$mensaje = '
				<html>
				<head>
				  <title>Orden de Pedido Número </title>
				</head>
				<body>
				  <p><strong>Orden de pedido número:'.$id.'</strong></p>
                  <p><strong>Fecha:'.$date.'</strong></p>
                  <p><strong>Documento Cliente:</strong>'.$customer->txtFirtsName.' '.$customer->txtSecondName.' '.$customer->txtLastName.' '.$customer->txtSecondLastName.'</p>
                  <p><strong>Nombre del Cliente:'.$customer->txtDocument.'</strong></p>
                  <p>&nbsp;</p>
                  <p><strong>Productos</strong></p>
				  <table>
					<tr>
					  <th>Nombre Producto</th><th>Valor</th><th>Catidad</th><th>Subtotal</th>
					</tr>
					';
					for ($i=0; $i<count($resp); $i++){
										$tmpprod = $resp[$i];
										$product = new Product('','','','','','','');
										$prod = $product->FindProduct('id',$tmpprod->intIdProduct);
					$mensaje .='<tr>
					  			<td>'.$prod[0]->txtDescription.'</td><td>'.$prod[0]->dbValue.'</td><td>'.$_POST['intQuantity'.$prod[0]->intId].'</td><td>'.$_POST['subTotal'.$prod[0]->intId].'</td>
								</tr>';
                    }
					
					$mensaje .='<tr>
					  <td>&nbsp;</td><td>&nbsp;</td><td>Total</td><td>'.$_POST['Total'].'</td>
					</tr>
				  </table>
				</body>
				</html>
				';
				
				// Para enviar un correo HTML, debe establecerse la cabecera Content-type
				$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
				$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				
				// Cabeceras adicionales
				$cabeceras .= 'To: Jonathan <jonathanbm88@hotmail.com>' . "\r\n";
				$cabeceras .= 'From: Recordatorio <cumples@example.com>' . "\r\n";
				/*$cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
				$cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";
				
				// Enviarlo
				mail($para, $título, $mensaje, $cabeceras);*/
				
				/*$destino ="jonathanbm88@hotmail.com";
				$asunto = "Contacto Web";
				$cabeceras = "Content-type: text/html";
				$cuerpo ="Hola, alguien te ha contactado por el formulario Web de tu sitio<br>
				Los datos enviados son los siguientes:<br>
				<b>Nombre:</b>Jonathan<br>
				<b>email:</b>jjjj<br>
				Y envio el siguiente comentario: <hr>
				<pre>
				sisisisisi
				</pre>";
				
				mail($destino,$asunto,$cuerpo,$cabeceras);
				
				echo "Se ha enviado el mensaje correctamente";*/
					
				
				$eliminatelistAll = $tmpProductOrder->DeletedTmpProductOrderAll($customer->intId,$date);
				
				echo "<script>alert ('La Orden de Pedido Numero ".$id." fue Creada con exito');</script>";
				unset($_SESSION['customer']);
				echo '<script>window.location="../fondo_presentacion.php";</script>';
			}else{
				$eliminatelistAll = $tmpProductOrder->DeletedTmpProductOrderAll($customer->intId,$date);
				unset($_SESSION['customer']);
				echo "<script>alert ('La Orden de Pedido no pudo ser creada, Intenta de nuevo');</script>";
				echo '<script>window.location="FindCustomerOrder.php";</script>';
			}				

		}
			if(!empty($_POST['action']) and $_POST['action']=='back'){
				$eliminatelistAll = $tmpProductOrder->DeletedTmpProductOrderAll($customer->intId,$date);
				echo '<script>window.location="../fondo_presentacion.php";</script>';
			}
		?>
		
		
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Crear Orden Pedido</title>
		<link href="../css/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript" src="../js/validaciones.js" type="text/javascript"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script>
        	$(document).ready(function(e) {
				var total=0;
				$(".subtotalproduct").each(function(index, element) {
					if($(this).val()!=""){
						total = total  + parseInt($(this).val());
					}
				});
				document.getElementById("Total").value = total;
				
                $(".cantidadproducto").blur(function(){
					//alert($(this).data("id"));
					$.ajax({
					 type: "POST",
					 url: "../classes/TmpProductOrder.php",
					 dataType: "json",
					 data: {e:"EditTmpProductOrder",quantity:$(this).val(),id:$(this).data("id"),valor:$(this).data("valor")}
					  }).done(function(){
					  
					 }).fail(function(){
					  
					  alert("Error. Please try again");
					  
					 });
					
				});
            });
        </script>
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
				<td width="30"><img src="../img/activar_opaco.png" width="30" height="29" title="Activar" /></td>
				<td width="30"><img src="../img/desactivar_opaco.png" width="30" height="29" title="Desactivar" /></td>
				<td width="33"><a href="FindOrder.php"><img src="../img/buscar_lupa.png" width="30" height="30" title="Buscar"  /></a></td>
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
					<td colspan="6" valign="middle" class="tamcolorletratitulos">CREAR ORDEN DE PEDIDO</td>
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
					<td align="left" class="tamcolorletraformulario">Fecha</td>
					<td align="left" class="tamcolorletraformulario">
					  <input name="tmpDate" type="text"  id="tmpDate" title="Fecha" value="<?php echo $date; ?>" size="20" readonly="readonly" disabled="disabled" /></td>
					<td align="left">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario">Documento</td>
					<td align="left" class="tamcolorletraformulario">
                    <input type="text" name="txtDocument" id="txtDocument" onkeypress="javascript:return Numeros(event)" title="Documento Cliente" value="<?php echo $customer->txtDocument; ?>" disabled="disabled" /></td>
				  </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" class="tamcolorletraformulario">Nombre Cliente</td>
				    <td colspan="4" align="left" class="tamcolorletraformulario">
                    <input name="txtName" type="text" id="txtName" class="campos_mayus" title="Nombre Cliente" size="50" value="<?php echo $customer->txtFirtsName.' '.$customer->txtSecondName.' '.$customer->txtLastName.' '.$customer->txtSecondLastName; ?>" disabled="disabled" /></td>
			      </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" class="tamcolorletraformulario">Email Cliente</td>
				    <td colspan="4" align="left" class="tamcolorletraformulario"><input name="txtEmail" type="text" id="txtEmail" title="Email del Cliente" size="50" value="<?php echo $customer->txtEmail?>"/></td>
			      </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" class="tamcolorletraformulario">Observacion:</td>
				    <td colspan="4" align="left" class="tamcolorletraformulario">&nbsp;</td>
			      </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td colspan="5" align="left" class="tamcolorletraformulario"><textarea name="txtObservation" id="txtObservation" cols="70" rows="5" class="campos_mayus" title="Ingresa la Observacion"></textarea></td>
			      </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td colspan="5" align="left" class="tamcolorletraformulario">Seleccionar Producto: <a href="javascript:SelectProduct(<?php echo $customer->intId; ?>,'<?php echo $date; ?>')"><img src="../img/buscar_lupa.png" width="20" height="20" /></a></td>
			      </tr>
				  <tr>
				    <td colspan="6" align="left" valign="middle">
				      
				      <?php 
					if(sizeof($resp)!=0){
			?>
				      <table width="680" border="1" align="center" cellpadding="0" cellspacing="0" class="tablaformulario">
				        <tr class="colorbarratitulos">
				          <td align="center" colspan="7" class="tamcolorletratitulos">PRODUCTOS SELECCIONADOS</td>
				          </tr>
				        <tr>
				          <td width="57" align="center">&nbsp;</td>
				          <td width="246">&nbsp;</td>
				          <td width="87" align="center" valign="middle">&nbsp;</td>
				          <td width="80" align="center" valign="middle">&nbsp;</td>
				          <td width="75" align="center" valign="middle">&nbsp;</td>
				          <td width="74" align="center" valign="middle">&nbsp;</td>
                          <td width="45" align="center" valign="middle">&nbsp;</td>
				          </tr>
				        <tr class="colorbarratitulos">
				          <td width="57" align="center" class="tamcolorletratitulostablaresul">Codigo</td>
				          <td width="246" align="center" class="tamcolorletratitulostablaresul">Descripcion</td>
				          <td width="87" align="center" class="tamcolorletratitulostablaresul">Valor</td>
                          <td width="80" align="center" class="tamcolorletratitulostablaresul">Inventario</td>
				          <td width="75" align="center" class="tamcolorletratitulostablaresul">Cantidad</td>
				          <td width="74" align="center" class="tamcolorletratitulostablaresul">Subtotal</td>
				          <td width="45" align="center" class="tamcolorletratitulostablaresul">Quitar</td>
				          </tr>
				        <?php
									for ($i=0; $i<count($resp); $i++){
										$tmpprod = $resp[$i];
										$product = new Product('','','','','','','');
										$prod = $product->FindProduct('id',$tmpprod->intIdProduct);
										$inventorys = new Inventory('',$prod[0]->intId,'','','');
										$saldo = $inventorys->FindProductInventory();
									?>
				        <tr align="left" class="TablaUsuarios">
				          <td width="57" align="center" class="tamcolorletraformulario"><?php echo $prod[0]->txtCod; ?></td>
				          <td width="246" class="tamcolorletraformulario"><?php echo $prod[0]->txtDescription; ?></td>
				          <td width="87" align="center" class="tamcolorletraformulario"><?php echo $prod[0]->dbValue; ?></td>
				          <td width="80" align="center" class="tamcolorletraformulario" style="color:#F00"><?php echo $saldo[0]->intQuantity; ?></td>
                          <td align="center"><input name="intQuantity<?php echo $prod[0]->intId;  ?>" type="text" id="intQuantity<?php echo $prod[0]->intId;  ?>" onchange="valSubtotal('<?php echo $prod[0]->intId; ?>','<?php echo $prod[0]->dbValue; ?>', '<?php echo $saldo[0]->intQuantity; ?>');" onkeypress="javascript:return Numeros(event)"  class="cantidadproducto" data-id="<?php echo $prod[0]->intId; ?>" data-valor="<?php echo $prod[0]->dbValue; ?>" size="5" value="<?php if(!empty($tmpprod->intQuantity )){ echo $tmpprod->intQuantity; } ?>" /></td>
				          <td width="74" align="center" valign="middle"><input name="subTotal<?php echo $prod[0]->intId;  ?>" type="text" id="subTotal<?php echo $prod[0]->intId;  ?>" size="8" class="subtotalproduct" readonly="readonly" value="<?php if(!empty($tmpprod->intSubTotal )){ echo $tmpprod->intSubTotal; } ?>" /></td>
				          <td width="45" align="center" valign="middle"><a href="javascript:elimante_product_order('delete','<?php echo $prod[0]->intId; ?>')" title="Quitar Producto"><img src="../img/desactivar.png" width="25" height="25" /><a></td>
				          
				          </tr>
				        <?php } ?>
				        <tr align="left" class="TablaUsuarios">
				          <td width="57" align="center" class="tamcolorletraformulario">&nbsp;</td>
				          <td width="246" class="tamcolorletraformulario">&nbsp;</td>
				          <td width="87" class="tamcolorletraformulario">&nbsp;</td>
                          <td width="74" align="center" valign="middle">&nbsp;</td>
				          <td align="center">TOTAL</td>
				          <td width="75" align="center" valign="middle"><input name="Total" type="text" id="Total" size="8" readonly="readonly" /></td>
				          <td width="74" align="center" valign="middle">&nbsp;</td>
				          
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