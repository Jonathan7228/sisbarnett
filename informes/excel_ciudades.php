<? 
session_start();
include_once '../clases/Ciudad.php';
$ciudad= new Ciudad('','','','','','','','','','');
$resp=$ciudad->buscarCiudad('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>Codigo</strong></td>
				<td align="center"><strong>Nombre </strong></td>
				<td align="center"><strong>Municipio </strong></td>
				<td align="center"><strong>Departamento</strong></td>
				<td align="center"><strong>Regional</strong></td>
				<td align="center"><strong>Ciudad Homologada</strong></td>
				<td align="center"><strong>Es Contraentrega</strong></td>
				<td align="center"><strong>Codigo Postal</strong></td>
				<td align="center"><strong>Estado</strong></td>
			</tr>';
		for ($i=0; $i<count($resp); $i++){
			$ciudad = $resp[$i];
			if($ciudad->estado==1){
				$estado="ACTIVO";
			}else{
				$estado="INACTIVO";
			}
			$excel.='<tr align="left" class="TablaUsuarios">
						<td align="center">'.$ciudad->codigo.'</td>
						<td>'.$ciudad->nombre.'</td>
						<td>'.$ciudad->municipio.'</td>
						<td>'.$ciudad->departamento.'</td>
						<td>'.$ciudad->regional.'</td>
						<td>'.$ciudad->homologada.'</td>
						<td>'.$ciudad->contraentrega.'</td>
						<td>'.$ciudad->codigo_postal.'</td>
						<td>'.$estado.'</td>
					 </tr>';
			} 
$excel .='</table>';		  
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=ciudades.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>