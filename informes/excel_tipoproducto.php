<?PHP
session_start();
include_once '../clases/TipoProducto.php';
$tipoproducto= new TipoProducto('','','');
$resp=$tipoproducto->buscarTipoProducto('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$tipopro = $resp[$i];
				if($tipopro->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$tipopro->id.'</td>
							<td align="left">'.$tipopro->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Tipos de Producto.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>