<?php
 session_start();
 include_once 'connection/Connection.php';
	include_once 'classes/User.php';
	if (!empty($_POST["txtDocument"])) {
		if ($_POST["txtDocument"]!='' && $_POST["txtPassword"]!='') {
			$_SESSION['txtDocument']=$_POST['txtDocument'];
			$user = new User("","",$_POST['txtDocument'],"",$_POST['txtPassword'],"","");
			$query = $user->authenticate();	
			if (!empty($query[0])) {
				if($query[0]->intStatus == '1'){
					$_SESSION["autenticated"] = 1;
					$_SESSION["id_user"] = $query[0]->intId;
					$_SESSION["DocumentUser"]= $query[0]->txtDocument;
					$_SESSION["NameUser"] = $query[0]->txtName;
					$_SESSION["profile"] = $query[0]->intProfile;				
					echo"<script language='javascript'>window.location='menu.php'</script>";
				
				}else{
					unset($_SESSION['document']);
					echo "<script>alert('Este usuario esta desactivado, pongase en contacto con el administrador del sistema');</script> ";
					echo '<script>window.location="index.php";</script>';
				}
			} else {
				echo"<script language='javascript'>alert('Documento o Password Incorrectos');</script>";
				echo"<script language='javascript'>window.location='index.php'</script>";
			}
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/js/validaciones.js"></script>
<title>Autenticaci&oacute;n de usuario</title>
</head>


	<form id="form1" name="form1" method="POST" action="">
    <table width="100%" height="100%" align="center">
    <tr>
    <td align="center" valign="middle">
    	<table>
        	<tr>
            	<td>&nbsp;</td>
            </tr>
            <tr>
            	<td>&nbsp;</td>
            </tr>
            <tr>
            	<td>&nbsp;</td>
            </tr>
            <tr>
            	<td>&nbsp;</td>
            </tr>
        </table>
    	<table width="300" align="center" border="0" cellpadding="0" cellspacing="0" class="tablaformularioindex" >
          <tr>
              <td height="131" align="center" valign="middle"><img src="img/logobarnett.jpg" width="166" height="160" /></td>
          </tr>
            <tr valign="top">
              <td height="32" align="center" valign="middle"><table width="250" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="45" align="left">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="3"><span class="tamcolorletraformulario">Cedula:</span></td>
                      <td width="82" align="left" class="tamcolorletraformulario">&nbsp;</td>
                    </tr>
                    <input type="hidden" id="tarea" name="tarea" />
                  </table></td>
                  <td align="left"><label>
                    <input name="txtDocument" type="text" id="txtDocument" size="20"/>
                  </label></td>
                </tr>
                <tr>
                  <td colspan="2" align="center">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left"><table width="95%" border="0" align="left" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="91" align="left" class="tamcolorletraformulario">Contrase&ntilde;a:</td>
                      <td width="91" align="left" class="tamcolorletraformulario">&nbsp;</td>
                    </tr>
                  </table></td>
                  <td align="left"><input name="txtPassword" type="password" id="txtPassword" size="20" /></td>
                </tr>
                <tr>
                  <td colspan="2" align="center">&nbsp;</td>
                </tr>
                <tr>
                  <td height="42" colspan="2" align="center"><input type="submit" name="Submit" value="Entrar" /></td>
                </tr>
                <tr align="right">
                  <td height="42" colspan="2">&nbsp;</td>
                </tr>
              </table> 
            
            </td>
          </tr>
      </table></td>
    </tr>
    </table>
</form> 
</body>
</html>

