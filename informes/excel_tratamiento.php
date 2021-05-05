<?PHP
session_start();
include_once '../clases/Tratamiento.php';
$resp= unserialize($_SESSION['tratamientos']);
$excel = '<table border="1">
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$tratamiento = $resp[$i];
				if($tratamiento->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$tratamiento->id.'</td>
							<td align="left">'.$tratamiento->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Tratamientos.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>