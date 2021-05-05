<?PHP
session_start();
include_once '../clases/TipoMetodoLiquidacion.php';
include_once '../clases/TipoProducto.php';
$resp=unserialize($_SESSION['metodos']);
$excel = '<table border="1">
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>TIPO DE PRODUCTO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>COSTO UNIDAD</strong></td>
				<td align="center"><strong>OBSERVACIONES</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$metodo = $resp[$i];
				if($metodo->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$tipoproducto = new TipoProducto($metodo->id_tipoproducto,'','');
				$prod= $tipoproducto->buscarTipoProducto();
				$excel .= '<tr>
							<td align="center">'.$metodo->id.'</td>
							<td align="left">'.$prod[0]->nombre.'</td>
							<td align="left">'.$metodo->nombre.'</td>
							<td align="left">'.$metodo->costo_unidad.'</td>
							<td align="left">'.$metodo->observaciones.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Tipo Metodos de Liquidacion.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>