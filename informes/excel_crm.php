<?PHP
session_start();
include_once '../clases/Crm.php';
include_once '../clases/Personal.php';
include_once '../clases/Regional.php';
$crm= new Crm('','','');
$resp=$crm->buscarCrm('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>SUCURSAL</strong></td>
				<td align="center"><strong>ACOPIO MOVIL</strong></td>
				<td align="center"><strong>PROMOTOR</strong></td>
				<td align="center"><strong>AGENCIA COMERCIAL</strong></td>
				<td align="center"><strong>UBICADO EN LA BODEGA</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$Crm = $resp[$i];
				$promotor = new Empleado('','','','','','','','','','','','');
				$promotores = $promotor->buscarEmpleado('id',$Crm->promotor);
				$regional = new Regional($Crm->id_regional,'','','');
				$regionales = $regional->buscarRegional(2);
				if($Crm->acopio_movil==1){
					$acopio_movil="SI";
				}else{
					$acopio_movil="NO";
				}
				
				if($Crm->agencia_comercial==1){
					$agencia_comercial="SI";
				}else{
					$agencia_comercial="NO";
				}
				
				if($Crm->ubicacion_bodega==1){
					$ubicacion_bodega="SI";
				}else{
					$ubicacion_bodega="NO";
				}
				
				if($Crm->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$Crm->codigo.'</td>							
							<td align="left">'.$Crm->nombre.'</td>
							<td align="left">'.$regionales[0]->nombre.'</td>
							<td align="left">'.$acopio_movil.'</td>
							<td align="left">'.$promotores[0]->nombre1.' '.$promotores[0]->nombre2.' '.$promotores[0]->apellido1.' '.$promotores[0]->apellido2.'</td>
							<td align="left">'.$agencia_comercial.'</td>
							<td align="left">'.$ubicacion_bodega.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Crm.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>