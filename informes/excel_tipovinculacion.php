<?PHP
session_start();
include_once '../clases/TipoVinculacion.php';
$tipovinculacion= new TipoVinculacion('','','');
$resp=$tipovinculacion->buscarTipoVinculacion('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$tipovin = $resp[$i];
				if($tipovin->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$tipovin->id.'</td>
							<td align="left">'.$tipovin->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Tipo de Vinculaciones.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>