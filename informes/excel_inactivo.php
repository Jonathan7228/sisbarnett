<?PHP
session_start();
include_once '../clases/Inactivo.php';
$resp= unserialize($_SESSION['inactivos']);
$excel = '<table border="1">
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$inactivo = $resp[$i];
				if($inactivo->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$inactivo->id.'</td>
							<td align="left">'.$inactivo->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Inactivos.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>