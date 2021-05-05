<?PHP
session_start();
include_once '../clases/Producto.php';
$resp= unserialize($_SESSION['productos']);
$excel = '<table border="1">
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$producto = $resp[$i];
				if($producto->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$producto->codigo.'</td>
							<td align="left">'.$producto->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Productos.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>