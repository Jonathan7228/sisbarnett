<?php 
session_start();
if($_SESSION["profile"]=='1'){
	include_once '../classes/User.php';
	include_once '../connection/Connection.php';
	include_once '../classes/LogUser.php';
	$date = date('Y-m-d');
	
	$user = unserialize($_SESSION['user']);
		
	if(!empty($_POST['action']) && $_POST['action'] == 'edit'){	
		
		if($_SESSION['PASS']==1){
			$user= new User($user->intId, '','','',$_POST['txtPassword'],'','');
			$save = $user->editPassUser();
			$txtName = $user->txtName;
			$txtDescription = 'EDICION PASSWORD';
		}else{
			$_POST['txtName']=strtoupper($_POST['txtName']);
			$user= new User($user->intId, $_POST['intProfile'],$user->txtDocument,$_POST['txtName'],'','','');
			$save=$user->editUser();
			$txtName = $_POST['txtName'];
			$txtDescription = 'EDICION DATOS';
		}
		
		if($save){
			$log = new LogUser('',$_SESSION["DocumentUser"],$_SESSION["NameUser"],$user->txtDocument,$txtName,$txtDescription,'');
			$savelog = $log->saveLogUser();
			echo "<script>alert ('El Usuario fue editado con exito');</script>";
			unset($_SESSION['PASS']);
			echo '<script>window.location="FindUser.php";</script>';		
		}else{
			echo "<script>alert ('El Usuario no pudo ser editado, intenta de nuevo');</script>";
		}

	}
	
	if(!empty($_POST['action']) and $_POST['action']=='activate'){
		$sta_user= new User($user->intId,$user->intProfile,$user->txtDocument,$user->txtName,$user->txtPassword,$user->intStatus,$user->tmpDate);
		$state = $sta_user->activateDesactivateUser('1');
		$user->intStatus="1";
		if($state){
			$log = new LogUser('',$_SESSION["DocumentUser"],$_SESSION["NameUser"],$user->txtDocument,$user->txtName,'ACTIVACION USUARIO','');
			$savelog = $log->saveLogUser();
			$_SESSION['user']=serialize($user);
			echo "<script>alert('El Usuario ha sido activado correctamente');</script> ";
			echo '<script>window.location="EditViewUser.php";</script>';
		}else{
			echo "<script>alert('El Cliente no pudo ser activado, intentelo nuevamente');</script> ";
			echo '<script>window.location="EditViewUser.php";</script>';
		}
	}
	
	if(!empty($_POST['action']) and $_POST['action']=='desactivate'){
		$sta_user= new User($user->intId,$user->intProfile,$user->txtDocument,$user->txtName,$user->txtPassword,$user->intStatus,$user->tmpDate);
		$state = $sta_user->activateDesactivateUser('2');
		$user->intStatus="2";
		if($state){
			$log = new LogUser('',$_SESSION["DocumentUser"],$_SESSION["NameUser"],$user->txtDocument,$user->txtName,'DESACTIVACION USUARIO','');
			$savelog = $log->saveLogUser();
			$_SESSION['user']=serialize($user);
			echo "<script>alert('El Usuario ha sido activado correctamente');</script> ";
			echo '<script>window.location="EditViewUser.php";</script>';
		}else{
			echo "<script>alert('El Cliente no pudo ser activado, intentelo nuevamente');</script> ";
			echo '<script>window.location="EditViewUser.php";</script>';
		}
	}

	if(!empty($_POST['action']) and $_POST['action']=='back'){
		unset($_SESSION['PASS']);
		echo '<script>window.location="../fondo_presentacion.php";</script>';
	}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar Usuario</title>
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
        <td width="30">
       		<?php 
				if($user->intStatus == 1){?>
       				<a href="javascript:valuser('edit')"><img src="../img/guardar.png" width="30" height="30" title="Guardar"  /></a>
        	<?php 
				}else{?>
                    <img src="../img/guardar_opaco.png" width="30" height="30" title="Guardar"  />
			<?php 
				}
			?>
            </td>
         <td width="30">
			<?php 
				if($user->intStatus == 2){?>
              <a href="javascript:valuser('activate')"><img src="../img/activar.png" alt="activar" width="32" height="32" border="0" title="Activar"/></a>
            <?php 
				}else{?>
                  <img src="../img/activar_opaco.png" alt="activar" width="32" height="32" border="0" title="Activar"/>
            <?php 
				}
			?>
       </td>
       <td width="30">
         <?php 
				if($user->intStatus == 1){?>
         <a href="javascript:valuser('desactivate')"><img src="../img/desactivar.png" alt="desactivar" width="32" height="32" border="0" title="Desactivar" /></a>
         <?php 
				}else{?>
         <img src="../img/desactivar_opaco.png" alt="desactivar" width="32" height="32" border="0" title="Desactivar" />
         <?php 
				}
			?>
       </td>
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
            <td colspan="3" valign="middle" class="tamcolorletratitulos">EDITAR USUARIO</td>
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
					<select name="intProfile" id="intProfile" class="campos_mayus" title="Selecciona el Perfil" <?php if($user->intStatus == 2 || $_SESSION['PASS']==1){ echo 'disabled="disabled"';}?>  >
                        <option value=""></option>
                        <option value="1" <?php if($user->intProfile==1){ echo 'selected';}?>>Administrador</option>
                        <option value="2" <?php if($user->intProfile==2){ echo 'selected';}?>>Vendedor</option>
					</select>
              	</td>
           </tr>
          <tr>
            <td width="10" align="left" valign="middle">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Documento</td>
            <td align="left" class="tamcolorletraformulario">*
                <input name="txtDocument" type="text" id="txtDocument" title="Ingresa el Numero de Cedula" onkeypress="javascript:return Numeros(event)" size="20" value="<?php echo $user->txtDocument; ?>" readonly="readonly" <?php if($user->intStatus == 2 || $_SESSION['PASS']==1){ echo 'disabled="disabled"';}?>/>
                <input name="action" type="hidden" id="action" />
            </td>
         </tr>
            
          <tr>
            <td align="right" valign="middle">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Nombre</td>
            <td align="left" class="tamcolorletraformulario">*
              <input name="txtName" type="text" class="campos_mayus" id="txtName" title="Ingresa el Nombre del Usuario" size="30" maxlength="50" value="<?php echo $user->txtName; ?>" <?php if($user->intStatus == 2 || $_SESSION['PASS']==1){ echo 'disabled="disabled"';}?>/></td>
            </tr>
          <tr>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Contraseña</td>
            <td align="left" class="tamcolorletraformulario">*
              <input name="txtPassword" type="password" id="txtPassword" size="20" title="Ingresa el Password" <?php if($user->intStatus == 2 || $_SESSION['PASS']==0){ echo 'disabled="disabled"';}?> /></td>
          </tr>
          <tr>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="left" class="tamcolorletraformulario">Confirmar Contraseña</td>
            <td align="left" class="tamcolorletraformulario">*
              <input name="txtPassword2" type="password" id="txtPassword2" size="20" title="Ingresa el Password" <?php if($user->intStatus == 2 || $_SESSION['PASS']==0){ echo 'disabled="disabled"';}?> /></td>
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