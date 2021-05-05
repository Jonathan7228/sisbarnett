<?PHP
session_start();
include_once '../clases/EstadoGuia.php';
$responsable= new Responsable('','','');
$resp=$responsable->buscarResponsable('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$respon = $resp[$i];
				if($respon->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$respon->id.'</td>
							<td align="left">'.$respon->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Responsables.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>