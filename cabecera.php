<?php 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>

<script language="javascript">
<!-- Se abre el comentario para ocultar el script de navegadores antiguos

function muestraReloj(){
	// Compruebo si se puede ejecutar el script en el navegador del usuario
	if (!document.layers && !document.all && !document.getElementById) return;
	// Obtengo la hora actual y la divido en sus partes
	var fechacompleta = new Date();
	var horas = fechacompleta.getHours();
	var minutos = fechacompleta.getMinutes();
	var segundos = fechacompleta.getSeconds();
	var mt = "AM";
	// Pongo el formato 12 horas
	if (horas > 12) {
	mt = "PM";
	horas = horas - 12;
	}
	if (horas == 0) horas = 12;
	// Pongo minutos y segundos con dos dígitos
	if (minutos <= 9) minutos = "0" + minutos;
	if (segundos <= 9) segundos = "0" + segundos;
	// En la variable 'cadenareloj' puedes cambiar los colores y el tipo de fuente
	cadenareloj = "<font size='1' face='verdana' ><b>" + horas + ":" + minutos + ":" + segundos + " " + mt + "</b></font>";
	// Escribo el reloj de una manera u otra, según el navegador del usuario
	if (document.layers) {
		document.layers.spanreloj.document.write(cadenareloj);
		document.layers.spanreloj.document.close();
	}

	else if (document.all) spanreloj.innerHTML = cadenareloj;
	else if (document.getElementById) document.getElementById("spanreloj").innerHTML = cadenareloj;
	// Ejecuto la función con un intervalo de un segundo
	setTimeout("muestraReloj()", 1000);
}

// Fin del script -->
</script>

</head>

<body onLoad="muestraReloj()" style="background:none">
<form name="form_reloj">
<table width='100%' height="10px" >
	<tr>
    	<td width="15%" align="left" valign="bottom"><!--<img src="img/logobarnett.jpg" width="127" height="80" />--></td>
    	<td width="77%" align="center" valign="top"><!--<img src="img/eslogan.png" width="600" height="91" />--></td>
        <td width="8%" align="center" valign="bottom"><a href="logout.php"><img src="img/eqsl_exit.png" width="48" height="48" title="Salir" /></a></td>
    </tr>
	<tr>
	  <td width="15%" align="left" valign="bottom"></td>
	  <td align="right" valign="top" class="tamcolorletraformulario" > <input name="usuario" type="text" style="border:hidden; text-align:right; color:#666; font-size:12px; font-weight:900;"  onfocus="window.document.form_reloj.reloj.blur()" size="70" value="Usuario: <?php echo $_SESSION['NameUser']; ?>"></td>
	  <td align="center" valign="middle"  ><span id="spanreloj" class="tamcolorletraformulario"></span></td>
  </tr>
</table>
</form>
</body>
</html>
