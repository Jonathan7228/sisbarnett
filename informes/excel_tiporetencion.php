<?PHP
session_start();
include_once '../clases/TipoRetencion.php';
$resp= unserialize($_SESSION['tiporetenciones']);
$excel = '<table border="1">
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$tiporetencion = $resp[$i];
				if($tiporetencion->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$tiporetencion->id.'</td>
							<td align="left">'.$tiporetencion->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Tipo Retencion.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>