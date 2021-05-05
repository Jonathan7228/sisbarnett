<?PHP
session_start();
include_once '../clases/TipoDocumento.php';
$tipodocumento= new TipoDocumento('','','');
$resp=$tipodocumento->buscarTipoDocumento('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$tipodoc = $resp[$i];
				if($tipodoc->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$tipodoc->codigo.'</td>
							<td align="left">'.$tipodoc->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Tipos de documentos.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>