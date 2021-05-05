<?PHP
session_start();
include_once '../clases/TipoNegociacion.php';
$tiponegociacion= new TipoNegociacion('','','');
$resp=$tiponegociacion->buscarTipoNegociacion('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$tiponeg = $resp[$i];
				if($tiponeg->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$tiponeg->codigo.'</td>
							<td align="left">'.$tiponeg->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Tipos de Negociacion.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>