<? 
session_start();
include_once('../clases/CodigoNovedad.php');
include_once('../clases/Responsable.php');
include_once('../clases/Dependencia.php');
$resp=unserialize($_SESSION['codigos']);
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>RESPONSABILIDAD</strong></td>
				<td align="center"><strong>SE INCLUYE EN LOS INFORMES AUTOMATICOS</strong></td>
				<td align="center"><strong>SE CONSIDERA DEVOLUCION</strong></td>
				<td align="center"><strong>QUIEN ADMINISTRA LA GUIA</strong></td>
				<td align="center"><strong>NOVEDAD SE REPITE EN EL DIA</strong></td>
				<td align="center"><strong>REQUIERE OBSERVACION</strong></td>
				<td align="center"><strong>SE INCLUYE EN INFORMES</strong></td>
				<td align="center"><strong>PERMITE FIRMAR EN CUALQUIER ESTADO</strong></td>
				<td align="center"><strong>REPORTA NOVEDAD EN ESTADO FIRMADO</strong></td>
				<td align="center"><strong>CODIGO NOVEDAD ASOCIADA A LA WEB</strong></td>
				<td align="center"><strong>ESTADO DE LA NOVEDAD</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$codigo = $resp[$i];
				
				$responsable=new Responsable('','','');
				$responsables= $responsable->buscarResponsable('id',$codigo->responsabilidad);
				$dependencia= new Dependencia('','','');
				$dependencias= $dependencia->buscarDependencia('id',$codigo->admin_guia);
				if($codigo->estado==1){	$estado="ACTIVO"; }else{ $estado="INACTIVO"; }
				if($codigo->incluye_info==1){ $incluye_info="SI"; }else{ $incluye_info="NO"; }
				if($codigo->devolucion==1){ $devolucion="SI"; }else{ $devolucion="NO"; }
				if($codigo->repetir==1){ $repetir="SI"; }else{ $repetir="NO"; }
				if($codigo->observacion==1){ $observacion="SI"; }else{ $observacion="NO"; }
				if($codigo->incluye_eficacia==1){ $incluye_eficacia="SI"; }else{ $incluye_eficacia="NO"; }
				if($codigo->permite_firmar==1){ $permite_firmar="SI"; }else{ $permite_firmar="NO"; }
				if($codigo->rep_nov_firmada==1){ $rep_nov_firmada="SI"; }else{ $rep_nov_firmada="NO"; }
				if($codigo->estado_nov==1){ $estado_nov="SI"; }else{ $estado_nov="NO"; }
				$excel .= '<tr align="left" class="TablaUsuarios">
							<td>'.$codigo->codigo.'</td>
							<td>'.$codigo->nombre.'</td>
							<td>'.$responsables[0]->nombre.'</td>
							<td>'.$incluye_info.'</td>
							<td>'.$devolucion.'</td>
							<td>'.$dependencias[0]->nombre.'</td>
							<td>'.$repetir.'</td>
							<td>'.$observacion.'</td>
							<td>'.$incluye_eficacia.'</td>
							<td>'.$permite_firmar.'</td>
							<td>'.$rep_nov_firmada.'</td>
							<td>'.$codigo->nov_web.'</td>
							<td>'.$estado_nov.'</td>
							<td align="center">'.$estado.'</td>
						</tr>';
			} 
$excel .= '</table>';	  
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Codigo Novedades.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>