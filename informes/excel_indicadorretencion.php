<?PHP
session_start();
include_once '../clases/IndicadorRetencion.php';
$resp= unserialize($_SESSION['indicadores']);
$excel = '<table border="1">
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$indicador = $resp[$i];
				if($indicador->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$indicador->id.'</td>
							<td align="left">'.$indicador->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Indicador Retencion.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>