<? 
session_start();
include_once '../clases/Personal.php';
include_once '../clases/TipoDocumento.php';
include_once '../clases/TipoVinculacion.php';
include_once '../clases/Cargo.php';
include_once '../clases/Regional.php';
include_once '../clases/TipoProducto.php';
include_once '../clases/Observacion.php';
$resp=unserialize($_SESSION['personas']);
//$persona= new Personal('','','','','','','','','','','','','','','','','','','','','','','');
//$resp=$persona->buscarPersonal('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>TIPO DE DOCUMENTO</strong></td>
				<td align="center"><strong>TIPO DE PERSONA</strong></td>
				<td align="center"><strong>TIPO DE VINCULACION</strong></td>
				<td align="center"><strong>DOCUMENTO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>DIRECCION</strong></td>
				<td align="center"><strong>CIUDAD</strong></td>
				<td align="center"><strong>TELEFONO</strong></td>
				<td align="center"><strong>CELULAR</strong></td>
				<td align="center"><strong>EMAIL</strong></td>
				<td align="center"><strong>CARGO</strong></td>
				<td align="center"><strong>REGIONAL</strong></td>
				<td align="center"><strong>TIPO DE NEGOCIO</strong></td>
				<td align="center"><strong>NRO LICENCIA DE CONDUCCION</strong></td>
				<td align="center"><strong>CATEGORIA</strong></td>
				<td align="center"><strong>FECHA VENCIMIENTO LICENCIA DE CONDUCCION</strong></td>
				<td align="center"><strong>FECHA ULTIMO SEGUIMIENTO</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$perso = $resp[$i];
				$cargo = new Cargo('','','');
				$cargos = $cargo->buscarCargo('id',$perso->tipo_empleado);
				$regional = new Regional($perso->regional,'','','');
				$regionales = $regional->buscarRegional(2);
				$tipoproducto = new TipoProducto($perso->tipo_producto,'','','');
				$tipoproductos = $tipoproducto->buscarTipoProducto();
				$tipodocumento = new TipoDocumento('',$perso->tipo_documento,'','');
				$tipodocumentos = $tipodocumento->buscarTipoDocumento();
				$vinculacion = new TipoVinculacion('','','');
				$vinculaciones = $vinculacion->buscarTipoVinculacion('id',$perso->tipo_vinculacion);
				/*$obs = new Observacion('','',$perso->id,'','','');
				$observacion = $obs->buscarObservacion('id_otro','1');*/
				if($perso->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr align="left" class="TablaUsuarios">
							<td>'.$tipodocumentos[0]->nombre.'</td>
							<td>'.$perso->tipo_persona.'</td>
							<td>'.$vinculaciones[0]->nombre.'</td>
							<td>'.$perso->documento.'</td>
							<td align="left">'.$perso->nombre1.' '.$perso->nombre2.' '.$perso->apellido1.' '.$perso->apellido2.'</td>
							<td>'.$perso->direccion.'</td>
							<td>'.$perso->ciudad.'</td>
							<td>'.$perso->telefono.'</td>
							<td>'.$perso->celular.'</td>
							<td>'.$perso->email.'</td>
							<td align="left">'.$cargos[0]->nombre.'</td>
							<td align="left">'.$regionales[0]->nombre.'</td>
							<td align="left">'.$tipoproductos[0]->nombre.'</td>
							<td align="left">'.$perso->licencia_conduccion.'</td>
							<td align="left">'.$perso->categoria.'</td>
							<td align="left">'.$perso->fecha_ven_licencia.'</td>
							<td align="left">'.$perso->fecha_ult_seguimiento.'</td>
							<td align="center">'.$estado.'</td>
						</tr>';
						/*if($observacion){
							$excel .= '<tr><td align="center"><strong>OBSERVACIONES</strong></td></tr>
										<tr><tdalign="center"><strong>FECHA</strong></td><td align="center"><strong>OBSERVACION</strong></td></tr>';
							for ($j=0; $i<count($observacion); $j++){
								$obser = $observacion[$j];
								$excel .= '<tr><td>'.$obser->fecha.'</td><td>'.$obser->observacion.'</td></tr>';	
							}
							$excel .= '<tr><td></td></tr>';
						}*/
			} 
$excel .= '</table>';	  
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Personal.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>