<? 
session_start();
include_once '../clases/Cargo.php';
include_once '../clases/Dependencia.php';
$cargo= new Cargo('','','','');
$resp=$cargo->buscarCargo('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>Codigo</strong></td>
				<td align="center"><strong>Nombre </strong></td>
				<td align="center"><strong>Dependencia </strong></td>
				<td align="center"><strong>Estado</strong></td>
			</tr>';
		for ($i=0; $i<count($resp); $i++){
			$cargo = $resp[$i];
			$dependencia = new Dependencia('','','');
			$dependencias = $dependencia->buscarDependencia('id',$cargo->id_dependencia);
			if($cargo->estado==1){
				$estado="ACTIVO";
			}else{
				$estado="INACTIVO";
			}
			$excel.='<tr align="left" class="TablaUsuarios">
						<td align="center">'.$cargo->id.'</td>
						<td>'.$cargo->nombre.'</td>
						<td>'.$dependencias[0]->nombre.'</td>
						<td>'.$estado.'</td>
					 </tr>';
			} 
$excel .='</table>';		  
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=cargos.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>