<?PHP
session_start();
include_once '../clases/SectorEmpresarial.php';
$sectorempresarial= new SectorEmpresarial('','','');
$resp=$sectorempresarial->buscarSectorEmpresarial('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$sector = $resp[$i];
				if($sector->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$sector->id.'</td>
							<td align="left">'.$sector->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Sectores Empresariales.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>