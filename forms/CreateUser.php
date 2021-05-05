<?php 
session_start();
if($_SESSION["profile"]=='1'){	
	include_once '../classes/User.php';
	include_once '../connection/Connection.php';
	include_once '../classes/LogUser.php';
	$date = date('Y-m-d');
		
	if(!empty($_POST['action']) && $_POST['action'] == 'save'){	
		$_POST['txtName']=strtoupper($_POST['txtName']);
		$user= new User('', $_POST['intProfile'],$_POST['txtDocument'],$_POST['txtName'],$_POST['txtPassword'],'',$date);
		$existUser=$user->existUser();
		if(!$existUser){
			$id=$user->saveUser();
			if($id){
					$log = new LogUser('',$_SESSION["DocumentUser"],$_SESSION["NameUser"],$_POST['txtDocument'],$_POST['txtName'],'CREACION USUARIO','');
					$savelog = $log->saveLogUser();
				echo "<script>alert ('El Usuario fue creado con exito');</script>";		
			}else{
				echo "<script>alert ('El Usuario no pudo ser creado, intenta de nuevo');</script>";
			}
		}else{
			echo "<script>alert ('El Usuario ya existe, verifica por favor!');</script>";
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
<title>Crear Usuario</title>
<link href="../css/estilos.css" type="text/css" rel="stylesheet">
<script language="javascript" src="../js/validaciones.js" type="text/javascript"></script>
</head>

<body>
<form action="" method="post" name="form1" id="form1" target="basefrm" enctype="multipart/form-data">
<table width="1000" border="0">
  <tr align="left" valign="middle">
    <td><table width="175" height="62" border="0">
      <tr>
        <td width="30" height="50"><a href="javascript:valuser('back')"><img src="../img/flecha.png" width="30" height="30" title="Regresar" /></a></td>
        <td width="30"><a href="javascript:valuser('save')"><img src="../img/guardar.png" width="30" height="30" title="Guardar"  /></a></td>
        <td width="30"><img src="../img/activar_opaco.png" width="30" height="29" title="Activar" /></td>
        <td width="30"><img src="../img/desactivar_opaco.png" width="30" height="29" title="Desactivar" /></td>
        <td width="33"><a href="FindUser.php"><img src="../img/buscar_lupa.png" width="30" height="30" title="Buscar"  /></a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top"><table width="665" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="819" height="132" align="left" valign="top">
        <table width="500" border="0" align="center" cellpadding="2" cellspacing="0" class="tablaformulario" >
          <tr align="center">
            <td colspan="3" valign="middle">&nbsp;</td>
          </tr>
          <tr align="center" class="colorbarratitulos">
            <td colspan="3" valign="middle" class="tamcolorletratitulos">CREAR USUARIO</td>
            </tr>
          <tr>
            <td align="left" valign="middle">&nbsp;</td>
            <td width="158" align="center">&nbsp;</td>
            <td width="254" align="center">&nbsp;</td>
            </tr>
            <tr>
                <td align="right" valign="middle">&nbsp;</td>
                <td align="left" class="tamcolorletraformulario">Perfil</td>
                <td align="left" class="tamcolorletraformulario">*
					<select name="intProfile" id="intProfile" class="campos_mayus" title="Selecciona el Perfil"  >
                        <option value=""></option>
                        <option value="1">Administrador</option>
                        <option value="2">Vendedor</option>
					</select>
              	</td>
           </tr>
          <tr>
            <td width="10" align="left" valign="middle">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Documento</td>
            <td align="left" class="tamcolorletraformulario">*
                <input name="txtDocument" type="text" id="txtDocument" title="Ingresa el Numero de Cedula" onkeypress="javascript:return Numeros(event)" size="20"/>
                <input name="action" type="hidden" id="action" />
            </td>
         </tr>
            
          <tr>
            <td align="right" valign="middle">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Nombre</td>
            <td align="left" class="tamcolorletraformulario">*
              <input name="txtName" type="text" class="campos_mayus" id="txtName" title="Ingresa el Nombre del Usuario" size="30" maxlength="50"/></td>
            </tr>
          <tr>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Contraseña</td>
            <td align="left" class="tamcolorletraformulario">*
              <input name="txtPassword" type="password" id="txtPassword" size="20" title="Ingresa el Password" /></td>
          </tr>
          <tr>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Confirmar Contraseña</td>
            <td align="left" class="tamcolorletraformulario">*
              <input name="txtPassword2" type="password" id="txtPassword2" size="20" title="Ingresa el Password" /></td>
          </tr>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="left">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>
          </table></td>
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