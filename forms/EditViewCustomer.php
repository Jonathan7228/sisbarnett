<?php 
session_start();
if($_SESSION["profile"]=='1'){
include_once '../classes/Customer.php';
include_once '../classes/LogCustomer.php';
$customer=unserialize($_SESSION['customer']);

	if(!empty($_POST['action']) && $_POST['action'] == 'edit'){
		$_POST['txtFirtsName']=strtoupper($_POST['txtFirtsName']);
		$_POST['txtSecondName']=strtoupper($_POST['txtSecondName']);
		$_POST['txtLastName']=strtoupper($_POST['txtLastName']);
		$_POST['txtSecondLastName']=strtoupper($_POST['txtSecondLastName']);
		$_POST['txtaddress']=strtoupper($_POST['txtaddress']);
		$_POST['txtCity']=strtoupper($_POST['txtCity']);
		$_POST['txtObservation']=strtoupper($_POST['txtObservation']);
		$customer= new Customer($customer->intId,$customer->txtTypePerson,$customer->txtTypeDocument,$customer->txtDocument,$_POST['txtFirtsName'],$_POST['txtSecondName'],$_POST['txtLastName'],$_POST['txtSecondLastName'],$_POST['txtaddress'],$_POST['txtCity'],$_POST['txtPhone'],$_POST['txtCelPhone'],$_POST['txtEmail'],$_POST['txtObservation'],$customer->tmpDate,$customer->intState);			
		$edit=$customer->editCustomer();
		if($edit){
			$log = new LogCustomer('',$_SESSION["DocumentUser"],$_SESSION["NameUser"],$customer->txtDocument,$_POST['txtFirtsName'],$_POST['txtSecondName'],$_POST['txtLastName'],$_POST['txtSecondLastName'],'EDICION CLIENTE','');
			$savelog = $log->saveLogCustomer();
			echo "<script>alert ('El Cliente fue Editado con exito');</script>";
			/*echo '<script>window.location="Buscarcustomerl.php";</script>';*/
		}else{
			echo "<script>alert ('El Cliente no pudo ser Editado, Intenta de nuevo');</script>";
			/*echo '<script>window.location="EditarVercustomerl.php";</script>';*/
		}				
	}
	
	if(!empty($_POST['action']) and $_POST['action']=='activate'){
		$sta_cus= new Customer($customer->intId,$customer->txtTypePerson,$customer->txtTypeDocument,$customer->txtDocument,$customer->txtFirtsName,$customer->txtSecondName,$customer->txtLastName,$customer->txtSecondLastName,$customer->txtaddress,$customer->txtCity,$customer->txtPhone,$customer->txtCelPhone,$customer->txtEmail,$customer->txtObservation,$customer->tmpDate,$customer->intState);
		$state = $sta_cus->activateDesactivateCustomer('1');
		$customer->intState="1";
		$_SESSION['view']='2';
		if($state){
			$_SESSION['customer']=serialize($customer);
			$log = new LogCustomer('',$_SESSION["DocumentUser"],$_SESSION["NameUser"],$customer->txtDocument,$customer->txtFirtsName,$customer->txtSecondName,$customer->txtLastName,$customer->txtSecondLastName,'ACTIVACION CLIENTE','');
			$savelog = $log->saveLogCustomer();

			echo "<script>alert('El Cliente ha sido activado correctamente');</script> ";
			echo '<script>window.location="EditViewCustomer.php";</script>';
		}else{
			echo "<script>alert('El Cliente no pudo ser activado, intentelo nuevamente');</script> ";
			echo '<script>window.location="EditViewCustomer.php";</script>';
		}
	}
	
	if(!empty($_POST['action']) and $_POST['action']=='desactivate'){
		$sta_cus= new Customer($customer->intId,$customer->txtTypePerson,$customer->txtTypeDocument,$customer->txtDocument,$customer->txtFirtsName,$customer->txtSecondName,$customer->txtLastName,$customer->txtSecondLastName,$customer->txtaddress,$customer->txtCity,$customer->txtPhone,$customer->txtCelPhone,$customer->txtEmail,$customer->txtObservation,$customer->tmpDate,$customer->intState);
		$state = $sta_cus->activateDesactivateCustomer('2');
		$customer->intState="2";
		$_SESSION['view']='2';
		if($state){
			$_SESSION['customer']=serialize($customer);
			$log = new LogCustomer('',$_SESSION["DocumentUser"],$_SESSION["NameUser"],$customer->txtDocument,$customer->txtFirtsName,$customer->txtSecondName,$customer->txtLastName,$customer->txtSecondLastName,'DESACTIVACION CLIENTE','');
			$savelog = $log->saveLogCustomer();
			echo "<script>alert('El Cliente ha sido desactivado Correctamente');</script> ";
			echo '<script>window.location="EditViewCustomer.php";</script>';
		}else{
			echo "<script>alert('El Cliente no pudo ser desactivado, intentelo nuevamente');</script> ";
			echo '<script>window.location="EditViewCustomer.php";</script>';
		}
	}
	
	if(!empty($_POST['action']) and $_POST['action']=='back'){
		unset($_SESSION['customer']);
		echo '<script>window.location="../fondo_presentacion.php";</script>';
	}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar Cliente</title>
<link href="../css/estilos.css" type="text/css" rel="stylesheet">
<script language="javascript" src="../js/validaciones.js" type="text/javascript"></script>


</head>

<body <?php if($customer->intState=='1' && $_SESSION['view']=='2'){ echo 'onload="valtipovinculacioncampo(),valtipotercerocampo();"';} ?>>
<form action="" method="post" name="form1" id="form1" target="basefrm" enctype="multipart/form-data">
<table width="1000" border="0">
  <tr align="left" valign="middle">
    <td><table width="175" height="62" border="0">
      <tr>
        <td width="30" height="50"><a href="javascript:valcustomer('back')"><img src="../img/flecha.png" width="30" height="30" title="Regresar" /></a></td>
        <td width="30">
       		<?php 
				if($_SESSION['view']=='2' && $customer->intState == 1){?>
       				<a href="javascript:valcustomer('edit')"><img src="../img/guardar.png" width="30" height="30" title="Guardar"  /></a>
        	<?php 
				}else{?>
                    <img src="../img/guardar_opaco.png" width="30" height="30" title="Guardar"  />
			<?php 
				}
			?>
            </td>
         <td width="30">
			<?php 
				if($_SESSION['view']=='2' && $customer->intState == 2){?>
              <a href="javascript:valcustomer('activate')"><img src="../img/activar.png" alt="activar" width="32" height="32" border="0" title="Activar"/></a>
            <?php 
				}else{?>
                  <img src="../img/activar_opaco.png" alt="activar" width="32" height="32" border="0" title="Activar"/>
            <?php 
				}
			?>
       </td>
       <td width="30">
         <?php 
				if($_SESSION['view']=='2' && $customer->intState == 1){?>
         <a href="javascript:valcustomer('desactivate')"><img src="../img/desactivar.png" alt="desactivar" width="32" height="32" border="0" title="Desactivar" /></a>
         <?php 
				}else{?>
         <img src="../img/desactivar_opaco.png" alt="desactivar" width="32" height="32" border="0" title="Desactivar" />
         <?php 
				}
			?>
       </td>
        <td width="33"><a href="FindCustomer.php"><img src="../img/buscar_lupa.png" width="30" height="30" title="Buscar"  /></a></td>
        </tr>
    </table>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top"><table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="819" height="132" align="left" valign="top">
        <table width="800" border="0" align="left" cellpadding="2" cellspacing="0" class="tablaformulario" >
          <tr align="center">
            <td colspan="6" valign="middle">&nbsp;</td>
            </tr>
          <tr align="center" class="colorbarratitulos">
            <td colspan="6" valign="middle" class="tamcolorletratitulos"><?php if($_SESSION['view']=='1'){ echo 'VER CLIENTE'; } else {echo 'EDITAR CLIENTE'; }?></td>
            </tr>
          <tr>
            <td align="left" valign="middle">&nbsp;</td>
            <td width="153" align="center"><input name="action" type="hidden" id="action" /></td>
            <td width="194" align="center">&nbsp;</td>
            <td width="1" align="center">&nbsp;</td>
            <td width="127" align="center">&nbsp;</td>
            <td width="174" align="center">&nbsp;</td>
            </tr>
          <tr>
            <td align="left" valign="middle">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Fecha Creacion</td>
            <td align="left" class="tamcolorletraformulario">*
              <input name="tmpDate" type="text" class="campofecha" id="tmpDate" title="Fecha de Creacion" size="20" value="<?php echo $customer->tmpDate; ?>"  <?php if($customer->intState == 2 || $_SESSION['view']=='1'){ echo 'disabled="disabled"';}?> readonly="readonly" /></td>
            <td align="left">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Tipo de customer</td>
            <td align="left" class="tamcolorletraformulario">*
              <select name="txtTypePerson" id="txtTypePerson" class="campos_mayus" title="Selecciona el tipo de Persona" disabled="disabled"  >
                <option value=""></option>
                <option value="NATURAL" <?php if($customer->txtTypePerson=='NATURAL'){ echo 'selected'; } ?>>NATURAL</option>
                <option value="JURIDICO" <?php if($customer->txtTypePerson=='JURIDICO'){ echo 'selected'; } ?>>JURIDICO</option>
              </select></td>
          </tr>
          <tr>
            <td width="1" align="left" valign="middle">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Tipo de Documento</td>
            <td align="left" class="tamcolorletraformulario">
            	*
            	<select name="txtTypeDocument" id="txtTypeDocument" class="campos_mayus" title="Selecciona el Tipo de Documento del Cliente" onchange="valtipodoccampo(this.value);" onload="valtipodoccampo(this.value);" disabled="disabled"  >
					<option value=""></option>
                    <option value="CC" <?php if($customer->txtTypeDocument=='CC'){ echo 'selected'; } ?>>Cedula Ciudadania</option>
                    <option value="CE" <?php if($customer->txtTypeDocument=='CE'){ echo 'selected'; } ?>>Cedula Extrangeria</option>
                    <option value="NIT" <?php if($customer->txtTypeDocument=='NIT'){ echo 'selected'; } ?>>Nit</option>
				</select>
            </td>
            <td align="left">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Documento</td>
            <td align="left" class="tamcolorletraformulario">*
              <input type="text" name="txtDocument" id="txtDocument" onkeypress="javascript:return Numeros(event)" title="Ingresa el Documento del Cliente" disabled="disabled"  value="<?php echo $customer->txtDocument; ?>"/></td>
            </tr>
          <tr>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario"><div id="primernom">Primer Nombre</div><div id="razonso" style="display:none; ">Razon Social</div></td>
            <td align="left" class="tamcolorletraformulario">*
              <input type="text" name="txtFirtsName" id="txtFirtsName" class="campos_mayus" title="Ingresa el Primer Nombre de la customer" value="<?php echo $customer->txtFirtsName; ?>" <?php if($customer->intState == 2 || $_SESSION['view']=='1'){ echo 'disabled="disabled"';}?> /></td>
            <td align="left">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Segundo Nombre</td>
            <td align="left">&nbsp;&nbsp; <input type="text" name="txtSecondName" id="txtSecondName" class="campos_mayus" title="Ingresa el Segundo Nombre del cliente" value="<?php echo $customer->txtSecondName; ?>" <?php if($customer->intState == 2 || $_SESSION['view']=='1'){ echo 'disabled="disabled"';}?> /></td>
          </tr>
          <tr>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Primer Apellido</td>
            <td align="left" class="tamcolorletraformulario">*
              <input type="text" name="txtLastName" id="txtLastName" class="campos_mayus" title="Ingresa el Primer Apellido del Cliente" value="<?php echo $customer->txtLastName; ?>" <?php if($customer->intState == 2 || $_SESSION['view']=='1'){ echo 'disabled="disabled"';}?> /></td>
            <td align="left">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Segundo Apellido</td>
            <td align="left" class="tamcolorletraformulario">*				
              <input type="text" name="txtSecondLastName" id="txtSecondLastName" class="campos_mayus" title="Ingresa el Segundo Apellido del Cliente" value="<?php echo $customer->txtSecondLastName; ?>" <?php if($customer->intState == 2 || $_SESSION['view']=='1'){ echo 'disabled="disabled"';}?> /></td>
          </tr>
          <tr>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Direccion</td>
            <td align="left" class="tamcolorletraformulario">
            	*
            	  <input type="text" name="txtaddress" id="txtaddress" class="campos_mayus" title="Ingresa la Direccion del Cliente" value="<?php echo $customer->txtaddress; ?>" <?php if($customer->intState == 2 || $_SESSION['view']=='1'){ echo 'disabled="disabled"';}?> /></td>
            <td align="left">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Ciudad</td>
            <td align="left" class="tamcolorletraformulario">*              
              <input type="text" name="txtCity" id="txtCity" class="campos_mayus" title="Ingresa la Ciudad del Cliente" value="<?php echo $customer->txtCity; ?>" <?php if($customer->intState == 2 || $_SESSION['view']=='1'){ echo 'disabled="disabled"';}?> /></td>
          </tr>
          <tr>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Telefono</td>
            <td align="left" class="tamcolorletraformulario">
            	*
                  <input type="text" name="txtPhone" id="txtPhone" onkeypress="javascript:return Numeros(event)" title="Ingresa el Numero Telefonico del Cliente" value="<?php echo $customer->txtPhone; ?>" <?php if($customer->intState == 2 || $_SESSION['view']=='1'){ echo 'disabled="disabled"';}?> /></td>
            <td align="left">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Celular</td>
            <td align="left">&nbsp;&nbsp; <input type="text" name="txtCelPhone" id="txtCelPhone" onkeypress="javascript:return Numeros(event)" title="Ingresa el Numero de Celular del Cliente" value="<?php echo $customer->txtCelPhone; ?>" <?php if($customer->intState == 2 || $_SESSION['view']=='1'){ echo 'disabled="disabled"';}?> /></td>
          </tr>
          <tr>
            <td width="1" align="left" valign="middle">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">E-mail</td>
            <td colspan="4" align="left" class="tamcolorletraformulario">
              *
              <input name="txtEmail" type="text" id="txtEmail" title="Ingresa el E-mail del Cliente" size="50" value="<?php echo $customer->txtEmail; ?>" <?php if($customer->intState == 2 || $_SESSION['view']=='1'){ echo 'disabled="disabled"';}?> /></td>
            </tr>
          <tr>
            <td align="left" valign="middle">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Observacion:</td>
            <td colspan="4" align="left">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="middle">&nbsp;</td>
            <td colspan="5" align="left" class="tamcolorletraformulario"><textarea name="txtObservation" id="txtObservation" cols="88" rows="10" class="campos_mayus" title="Ingresa la Observacion" <?php if($customer->intState == 2 || $_SESSION['view']=='1'){ echo 'disabled="disabled"';}?>><?php echo $customer->txtObservation; ?></textarea></td>
          </tr>
          <tr>
            <td width="1" align="left" valign="middle">&nbsp;</td>
            <td colspan="5" align="left" class="tamcolorletraformulario">&nbsp;</td>
            </tr>
            </table>
            </td>
          </tr>

      <tr align="center">
            <td valign="middle">&nbsp;</td>
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