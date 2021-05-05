<?php 
session_start();
if($_SESSION["profile"]=='1'){
	include_once '../classes/User.php';
	include_once '../connection/Connection.php';
	
	$view_users = 0;

	if(!empty ($_POST['select']) and $_POST['select'] == "*"){
		$_POST['word'] = "*";
	 }
	if(!empty($_POST['select']) && !empty($_POST['word'])){
		$user= new User('','','','','','','');
		$resp=$user->findUser($_POST['select'],$_POST['word']);
		$_SESSION['users'] = serialize($resp);
		$view_users = 1;
	}
	if(!empty($_POST['action']) && $_POST['action'] == 'edit'){
	 	$users=unserialize($_SESSION['users']);
		for($i=0; $i<count($users); $i++){
			$user = $users[$i];
			if($user->intId==$_POST['id']){
				$_SESSION['user']=serialize($user);
				unset($_SESSION['users']);
				if($_POST['view']==1){
					$_SESSION['PASS']=1;
				}else{
					$_SESSION['PASS']=0;
				}
				echo "<script> window.location.href='EditViewUser.php';</script>";
			}
		}
	 }
	 
	 if(!empty($_POST['action']) && $_POST['action'] == 'exportar'){
		include '../informes/excel_usuarios.php';
		}
	
	if(!empty($_POST['action']) and $_POST['action']=='back'){
		unset($_SESSION['user']);
		unset($_SESSION['users']);
		echo '<script>window.location="../fondo_presentacion.php";</script>';
	}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Buscar Ususario</title>
<link href="../css/estilos.css" type="text/css" rel="stylesheet">
<script language="javascript" src="../js/validaciones.js" type="text/javascript"></script>
</head>

<body onload="document.form1.nombre.focus( )">
<form action="" method="post" name="form1" id="form1" target="basefrm" enctype="multipart/form-data"  >
<table width="175" height="62" border="0">
  <tr>
    <td width="30" height="50"><a href="javascript:valuser('back')"><img src="../img/flecha.png" width="30" height="30" title="Regresar" /></a></td>
    <td width="30"><img src="../img/guardar_opaco.png" alt="Guardar" width="30" height="30" title="Guardar"  /></a></td>
    <td width="30"><img src="../img/activar_opaco.png" alt="Activar" width="30" height="30" title="Activar" /></td>
    <td width="30"><img src="../img/desactivar_opaco.png" alt="Desactivar" width="30" height="30" title="Desactivar" /></td>
    <?php 	if($view_users == 1){ ?>
	  <?php }else{ ?>
	  <?php }	?>
    <td width="33"><a href="FindUser.php"><img src="../img/buscar_lupa.png" alt="Buscar" width="30" height="30" title="Buscar"  /></a></td>
    </tr>
</table>
<?php if($view_users == 0){?>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="819" height="132" align="center" valign="top">
        <table width="491" border="0" align="center" cellpadding="2" cellspacing="0" class="tablaformulario" >
          <tr align="center">
            <td colspan="4" valign="middle">&nbsp;</td>
          </tr>
          <tr align="center" class="colorbarratitulos">
            <td colspan="4" valign="middle" class="tamcolorletratitulos">BUSCAR USUARIO</td>
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
                        <option value="txtDocument">Documento</option>
                        <option value="txtName">Nombre</option>
                <option value="*">Todos</option>
                      </select>
              <input name="tarea" type="hidden" id="tarea" /></td>
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
  <table width="879" border="1" align="center" cellpadding="0" cellspacing="0" class="tablaformulario">
						  <tr class="colorbarratitulos">
						    <td colspan="6" align="center" class="tamcolorletratitulostablaresul"><strong>REGISTROS ENCONTRADOS </strong></td>
					      </tr>
						  
						  <tr class="colorbarratitulos">
                          <input name="action" type="hidden" id="action"/>
                                <input name="id" type="hidden" id="id"/>
                                <input name="view" type="hidden" id="view"/>
                            <td width="102" align="center" class="tamcolorletratitulostablaresul"><strong>Documento</strong></td>
							<td width="313" align="center" class="tamcolorletratitulostablaresul"><strong>Nombre Completo </strong></td>
							<td width="43" align="center" class="tamcolorletratitulostablaresul"><strong>Perfil</strong></td>
                            <td width="62" align="center" class="tamcolorletratitulostablaresul"><strong>Estado</strong></td>
                            <td width="55" align="center" class="tamcolorletratitulostablaresul"><strong>Editar Datos</strong></td>
                            <td width="55" align="center" class="tamcolorletratitulostablaresul"><strong>Editar Contraseña</strong></td>
						  </tr>
						  <?php
							for ($i=0; $i<count($resp); $i++){
								$us = $resp[$i];
							?>
							<tr align="left" class="TablaUsuarios">
                            	<td width="102" align="left"><?php echo ($us->txtDocument); ?></td>
							  <td width="313"><?php echo ($us->txtName); ?></td>
                                <td width="43" align="center"><?php if($us->intProfile==1){echo "ADMINISTRADOR";}else{echo "VENDEDOR";} ?></td>
                                <td width="62" align="center" valign="middle"><?php if($us->intStatus==1){echo "ACTIVO";}else{echo "INACTIVO";} ?></td>
                                <td width="55" align="center" valign="middle"><a href="javascript:send_form_edit('edit','<?php echo $us->intId; ?>','0')" title="Editar Informacion"><img src="../img/editar.png" width="25" height="25" /><a></td>
                                <td width="55" align="center" valign="middle"><a href="javascript:send_form_edit('edit','<?php echo $us->intId; ?>','1')" title="Editar Informacion"><img src="../img/editar.png" width="25" height="25" /><a></td>
                          </tr>
						<?php } ?>
			  </table>
			  <?php
						}else{
							$view_users = 0;
							echo "<script>alert ('No se encontro informacion, verifica por favor!');</script>";
							echo "<script> window.location.href='FindUser.php';</script>";
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