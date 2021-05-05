<?PHP
session_start();
include_once '../clases/TipoAsesor.php';
$tipoasesor= new TipoAsesor('','','');
$resp=$tipoasesor->buscarTipoAsesor('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$tipoase = $resp[$i];
				if($tipoase->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$tipoase->id.'</td>
							<td align="left">'.$tipoase->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Tipos de Asesor.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>