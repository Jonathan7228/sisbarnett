<?PHP
session_start();
include_once '../clases/EstadoGuia.php';
$estadoguia= new EstadoGuia('','','');
$resp=$estadoguia->buscarEstadoGuia('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$estguia = $resp[$i];
				if($estguia->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$estguia->codigo.'</td>
							<td align="left">'.$estguia->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Estado de Guias.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>