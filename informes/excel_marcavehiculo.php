<?PHP
session_start();
include_once '../clases/MarcaVehiculo.php';
$marcavehiculo= new MarcaVehiculo('','','');
$resp=$marcavehiculo->buscarMarcaVehiculo('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$marcavehiculo = $resp[$i];
				if($marcavehiculo->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$marcavehiculo->codigo.'</td>
							<td align="left">'.$marcavehiculo->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Marca de Vehiculos.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>