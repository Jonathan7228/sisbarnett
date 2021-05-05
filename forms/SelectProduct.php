<?php
 session_start();
include_once '../classes/Product.php';
include_once '../classes/TmpProductOrder.php';
include_once '../classes/Inventory.php';
$intIdCustomer = $_GET['intIdCustomer'];
$tmpDate = $_GET['tmpDate'];
			$view_product = 0;
		
			if(!empty ($_POST['select']) and $_POST['select'] == "*"){
				$_POST['word'] = "*";
			 }
			if(!empty($_POST['select']) && !empty($_POST['word'])){
				$product= new Product('','','','','','');
				$resp=$product->FindProduct($_POST['select'],$_POST['word']);
				$_SESSION['products'] = serialize($resp);
				$view_product = 1;
			}
			
			 if(!empty($_POST['action']) && $_POST['action'] == 'send'){
				$products=unserialize($_SESSION['products']);
				for($i=0; $i<count($products); $i++){
					$product = $products[$i];
					if($product->intId==$_POST['id']){
						$tmpProductOrder = new TmpProductOrder('',$intIdCustomer,$product->intId,'','',$tmpDate);
						$save = $tmpProductOrder->saveTmpProductOrder();
						$_SESSION['product']=serialize($product);
						unset($_SESSION['products']);
						echo "<script>window.opener.location = window.opener.location;</script>";
						echo "<script>window.close() </script>";
						
					}
				}
			 }

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Seleccionar Producto</title>
<link href="../css/estilos.css" type="text/css" rel="stylesheet">
<script language="javascript" src="../js/validaciones.js" type="text/javascript"></script>

</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><form action="" method="post" name="form2" id="form2" enctype="multipart/form-data" >
      <table width="700" height="62" border="0" align="center">
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">
			<?php if($view_product  == 0){?>
			  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
				<td width="819" height="132" align="center" valign="top">
				<table width="491" border="0" align="center" cellpadding="2" cellspacing="0" class="tablaformulario" >
				  <tr align="center">
					<td colspan="4" valign="middle">&nbsp;</td>
				  </tr>
				  <tr align="center" class="colorbarratitulos">
					<td colspan="4" valign="middle" class="tamcolorletratitulos">SELECCIONAR PRODUCTO</td>
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
								<option value="txtCod">Codigo</option>
								<option value="txtDescription">Descripcion</option>
								<option value="*">Todos</option>
							  </select>
					  <input name="action" type="hidden" id="action" /></td>
				  </tr>
				  <tr>
					<td align="right" valign="middle">&nbsp;</td>
					<td colspan="2" align="left" class="tamcolorletraformulario">Informacion a Buscar</td>
					<td align="left" class="tamcolorletraformulario">*	<input name="word" type="text" id="word" size="30" maxlength="50" class="campos_mayus" title="Ingresa el filtro de busqueda"/></td>
				  </tr>
					<tr>
							<td height="58" colspan="4" align="center"><a href="javascript:valfielfind('1','buscar')"><img src="../img/boton_buscar.png" width="80" height="30" /></a></td>
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
			 <table width="600" border="1" align="center" cellpadding="0" cellspacing="0" class="tablaformulario">
								  <tr class="colorbarratitulos">
									<td colspan="4" align="center" class="tamcolorletratitulos">REGISTROS ENCONTRADOS</td>
								  </tr>
								  <tr>
									<td width="67" align="center">
										<input name="action" type="hidden" id="action"/>
										<input name="id" type="hidden" id="id"/>
										<input name="view" type="hidden" id="view"/>
									</td>
									<td width="316">&nbsp;</td>
									<td width="159" align="center" valign="middle">&nbsp;</td>
									<td width="48" align="center" valign="middle">&nbsp;</td>
								  </tr>
								  <tr class="colorbarratitulos">
									<td width="67" align="center" class="tamcolorletratitulostablaresul">Codigo</td>
									<td width="316" align="center" class="tamcolorletratitulostablaresul">Descripcion</td>
									<td width="159" align="center" class="tamcolorletratitulostablaresul">Valor</td>
									<td width="48" align="center" class="tamcolorletratitulostablaresul">Seleccionar</td>
								  </tr>
								  <?php
									for ($i=0; $i<count($resp); $i++){
										$prod = $resp[$i];
										$inventory = new Inventory('',$prod->intId,'','');
										$inv = $inventory->FindProductInventory();
										if($inv){
									?>
									<tr align="left" class="TablaUsuarios">
										<td width="67" align="center"><?php echo $prod->txtCod; ?></td>
										<td width="316"><?php echo $prod->txtDescription; ?></td>
                                        <td width="159"><?php echo $prod->dbValue; ?></td>
										<td width="48" align="center" valign="middle"><a href="javascript:selectProduct('<?php echo $prod->intId; ?>','send')"><img src="../img/seleccionar.png" width="28" height="28" /></a></td>
                                        
                                  </tr>
								<?php 
								} 
									}?>
		  </table>
						<?php
						}else{
							echo "No hay resultados para esta consulta";
						}
					}
						?>			
			</td>
          </tr>
          <tr>
            <td align="center" valign="middle"></td>
          </tr>
        </table>
        <p>&nbsp;</p>
    </form>
    </td>
  </tr>
</table>
</body>
</html>
