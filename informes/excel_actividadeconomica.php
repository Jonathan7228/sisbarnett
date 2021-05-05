<?PHP
session_start();
include_once '../clases/ActividadEconomica.php';
$resp= unserialize($_SESSION['actividades']);
$excel = '<table border="1">
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$actividad = $resp[$i];
				if($actividad->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$actividad->codigo.'</td>
							<td align="left">'.$actividad->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Actividad Economica.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>