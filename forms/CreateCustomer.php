<?php 
include_once '../classes/Customer.php';
include_once '../classes/LogCustomer.php';
session_start();
if($_SESSION["profile"]=='1'){
$date=date('Y-m-d');
		
		if(!empty($_POST['action']) && $_POST['action'] == 'save'){

			$_POST['txtFirtsName']=strtoupper($_POST['txtFirtsName']);
			$_POST['txtSecondName']=strtoupper($_POST['txtSecondName']);
			$_POST['txtLastName']=strtoupper($_POST['txtLastName']);
			$_POST['txtSecondLastName']=strtoupper($_POST['txtSecondLastName']);
			$_POST['txtaddress']=strtoupper($_POST['txtaddress']);
			$_POST['txtCity']=strtoupper($_POST['txtCity']);
			$_POST['txtObservation']=strtoupper($_POST['txtObservation']);
			
			$customer= new Customer('',$_POST['txtTypePerson'],$_POST['txtTypeDocument'],$_POST['txtDocument'],$_POST['txtFirtsName'],$_POST['txtSecondName'],$_POST['txtLastName'],$_POST['txtSecondLastName'],$_POST['txtaddress'],$_POST['txtCity'],$_POST['txtPhone'],$_POST['txtCelPhone'],$_POST['txtEmail'],$_POST['txtObservation'],$_POST['tmpDate'],'');
			$existCustomer=$customer->existCustomer();
			if(!$existCustomer){
				$id=$customer->saveCustomer();
				if($id){
					$log = new LogCustomer('',$_SESSION["DocumentUser"],$_SESSION["NameUser"],$_POST['txtDocument'],$_POST['txtFirtsName'],$_POST['txtSecondName'],$_POST['txtLastName'],$_POST['txtSecondLastName'],'CREACION CLIENTE','');
					$savelog = $log->saveLogCustomer();
					echo "<script>alert ('El cliente fue creado con exito');</script>";
					echo '<script>window.location="CreateCustomer.php";</script>';
				}else{
					echo "<script>alert ('El cliente no pudo ser creado, Intenta de nuevo');</script>";
					echo '<script>window.location="CreateCustomer.php";</script>';
				}				
			}else{
				echo "<script>alert ('El cliente ya existe, verifica por favor!');</script>";
				echo '<script>window.location="CreateCustomer.php";</script>';
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
		<title>Crear Personal</title>
		<link href="../css/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript" src="../js/validaciones.js" type="text/javascript"></script>


		</head>
		
		<body>
		<form action="" method="post" name="form1" id="form1" target="basefrm" enctype="multipart/form-data">
		<table width="1000" border="0">
		  <tr align="left" valign="middle">
			<td><table width="175" height="62" border="0">
			  <tr>
				<td width="30" height="50"><a href="javascript:valcustomer('back')"><img src="../img/flecha.png" width="30" height="30" title="Regresar" /></a></td>
				<td width="30"><a href="javascript:valcustomer('save')"><img src="../img/guardar.png" width="30" height="30" title="Guardar"  /></a></td>
				<td width="30"><img src="../img/activar_opaco.png" width="30" height="29" title="Activar" /></td>
				<td width="30"><img src="../img/desactivar_opaco.png" width="30" height="29" title="Desactivar" /></td>
				<td width="33"><a href="FindCustomer.php"><img src="../img/buscar_lupa.png" width="30" height="30" title="Buscar"  /></a></td>
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
				<table width="750" border="0" align="left" cellpadding="2" cellspacing="0" class="tablaformulario" >
				  <tr align="center">
					<td colspan="6" valign="middle">&nbsp;</td>
					</tr>
				  <tr align="center" class="colorbarratitulos">
					<td colspan="6" valign="middle" class="tamcolorletratitulos">CREAR CLIENTE</td>
					</tr>
				  <tr>
					<td align="left" valign="middle">&nbsp;</td>
					<td width="146" align="center"><input name="action" type="hidden" id="action" /></td>
					<td width="167" align="center">&nbsp;</td>
					<td width="1" align="center">&nbsp;</td>
					<td width="139" align="center">&nbsp;</td>
					<td width="169" align="center">&nbsp;</td>
					</tr>
				  <tr>
					<td align="left" valign="middle">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario">Fecha</td>
					<td align="left" class="tamcolorletraformulario">*
					  <input name="tmpDate" type="text"  id="tmpDate" title="Fecha" value="<?php echo $date; ?>" size="10" readonly="readonly" /></td>
					<td align="left">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario">Tipo de Persona</td>
					<td align="left" class="tamcolorletraformulario">*
                      <select name="txtTypePerson" id="txtTypePerson" class="campos_mayus" title="Selecciona el tipo de Persona"  >
                        <option value=""></option>
                        <option value="NATURAL">NATURAL</option>
                        <option value="JURIDICO">JURIDICO</option>
                    </select></td>
				  </tr>
				  <tr>
					<td width="2" align="left" valign="middle">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario">Tipo de Documento</td>
					<td align="left" class="tamcolorletraformulario">
						*
						<select name="txtTypeDocument" id="txtTypeDocument" class="campos_mayus" title="Selecciona el Tipo de Documento del Cliente" onChange="valtipodoccampo();"  >
							<option value=""></option>
							<option value="CC">Cedula Ciudadania</option>
                            <option value="CE">Cedula Extrangeria</option>
                            <option value="NIT">Nit</option>
						</select>
					</td>
					<td align="left">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario">Documento</td>
					<td align="left" class="tamcolorletraformulario">*
                    <input type="text" name="txtDocument" id="txtDocument" onkeypress="javascript:return Numeros(event)" title="Ingresa el Documento del Cliente" /></td>
					</tr>
				  <tr>
					<td align="center" valign="middle">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario"><div id="primernom">Primer Nombre</div><div id="razonso" style="display:none; ">Razon Social</div></td>
					<td align="left" class="tamcolorletraformulario">*
					  <input type="text" name="txtFirtsName" id="txtFirtsName" class="campos_mayus" title="Ingresa el Primer Nombre del Cliente" /></td>
					<td align="left">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario">Segundo Nombre</td>
					<td align="left">&nbsp;&nbsp; <input type="text" name="txtSecondName" id="txtSecondName" class="campos_mayus" title="Ingresa el Segundo Nombre del Cliente" /></td>
				  </tr>
				  <tr>
					<td align="center" valign="middle">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario">Primer Apellido</td>
					<td align="left" class="tamcolorletraformulario">&nbsp;&nbsp;
					<input type="text" name="txtLastName" id="txtLastName" class="campos_mayus" title="Ingresa el Primer Apellido del Cliente" /></td>
					<td align="left">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario">Segundo Apellido</td>
					<td align="left" class="tamcolorletraformulario">&nbsp;&nbsp;
					<input type="text" name="txtSecondLastName" id="txtSecondLastName" class="campos_mayus" title="Ingresa el Segundo Apellido del Cliente" /></td>
				  </tr>
				  <tr>
					<td align="center" valign="middle">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario">Direccion</td>
					<td align="left">
						*
						  <input type="text" name="txtaddress" id="txtaddress" class="campos_mayus" title="Ingresa la Direccion del Cliente" /></td>
					<td align="left">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario">Ciudad</td>
					<td align="left" class="tamcolorletraformulario">*              
					  <input type="text" name="txtCity" id="txtCity" class="campos_mayus" title="Ingresa la Ciudad del Cliente" /></td>
				  </tr>
				  <tr>
					<td align="center" valign="middle">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario">Telefono</td>
					<td align="left" class="tamcolorletraformulario">
						*
						  <input type="text" name="txtPhone" id="txtPhone" onKeyPress="javascript:return Numeros(event)" title="Ingresa el Numero Telefonico del Cliente" /></td>
					<td align="left">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario">Celular</td>
					<td align="left">&nbsp;&nbsp; <input type="text" name="txtCelPhone" id="txtCelPhone" onKeyPress="javascript:return Numeros(event)" title="Ingresa el Numero de Celular del Cliente" /></td>
				  </tr>
				  <tr>
					<td align="left" valign="middle">&nbsp;</td>
					<td align="left" class="tamcolorletraformulario">E-mail</td>
					<td colspan="4" align="left">&nbsp;&nbsp; <input name="txtEmail" type="text" id="txtEmail" title="Ingresa el E-mail del Cliente" size="50" /></td>
				  </tr>
					</table>
					</td>
				  </tr>
					<tr>
					  <td>
					  
					  <table width="750" border="0" align="left" cellpadding="0" cellspacing="0" class="tablaformulario" >
						<tr>
						  <td width="1" align="center" valign="middle">&nbsp;</td>
						  <td width="83" align="left" class="tamcolorletraformulario">Observacion:</td>
						  <td width="423" align="left">&nbsp;</td>
						</tr>
						<tr>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td colspan="2" align="left"><textarea name="txtObservation" id="txtObservation" cols="88" rows="10" class="campos_mayus" title="Ingresa la Observacion"></textarea></td>
						</tr>
						<tr>
						  <td align="center" valign="middle">&nbsp;</td>
						  <td align="left">&nbsp;</td>
						  <td align="left">&nbsp;</td>
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