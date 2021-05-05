<?PHP
session_start();
include_once '../clases/TipoVehiculo.php';
$tipovehiculo= new TipoVehiculo('','','');
$resp=$tipovehiculo->buscarTipoVehiculo('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$tipoveh = $resp[$i];
				if($tipoveh->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$tipoveh->id.'</td>
							<td align="left">'.$tipoveh->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Tipo de Vehiculos.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>