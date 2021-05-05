<? 
session_start();
include_once '../clases/Vehiculo.php';
include_once '../clases/Personal.php';
include_once '../clases/TipoVehiculo.php';
include_once '../clases/MarcaVehiculo.php';
include_once '../clases/LineaMarca.php';
include_once '../clases/Color.php';
include_once '../clases/Carroceria.php';
include_once '../clases/Semirremolque.php';
include_once '../clases/Observacion.php';
$resp=unserialize($_SESSION['vehiculos']);
$excel = '<table>
			<tr>
				<td align="center"><strong>PLACA</strong></td>
				<td align="center"><strong>TIPO DE VEHICULO</strong></td>
				<td align="center"><strong>MARCA</strong></td>
				<td align="center"><strong>LINEA</strong></td>
				<td align="center"><strong>COLOR</strong></td>
				<td align="center"><strong>CARROCERIA</strong></td>
				<td align="center"><strong>PESO VACIO</strong></td>
				<td align="center"><strong>PESO MAXIMO</strong></td>
				<td align="center"><strong>CAPACIDAD</strong></td>
				<td align="center"><strong>MODELO</strong></td>
				<td align="center"><strong>REPOTENCIADO</strong></td>
				<td align="center"><strong>TIPO DE COMBUSTIBLE</strong></td>
				<td align="center"><strong>NRO DEL MOTOR</strong></td>
				<td align="center"><strong>CONFIGURACION DE EJES</strong></td>
				<td align="center"><strong>TIPO</strong></td>
				<td align="center"><strong>PLACA DEL SEMIREMOLQUE</strong></td>
				<td align="center"><strong>MARCA DEL SEMIREMOLQUE</strong></td>
				<td align="center"><strong>REGISTRO NACIONAL DE CARGA</strong></td>
				<td align="center"><strong>PROPIETARIO</strong></td>
				<td align="center"><strong>TENENCIA</strong></td>
				<td align="center"><strong>CONDUCTOR</strong></td>
				<td align="center"><strong>CELULAR DEL CONDUCTOR</strong></td>
				<td align="center"><strong>ASEGURADORA DE RIESGOS DE MERCANCIA</strong></td>
				<td align="center"><strong>NRO DE POLIZA DE RIESGOS DE MERCANCIA</strong></td>
				<td align="center"><strong>FECHA VENCIMIENTO POLIZA DE RIESGOS DE MERCANCIA</strong></td>
				<td align="center"><strong>ASEGURADORA SOAT</strong></td>
				<td align="center"><strong>NRO POLIZA SOAT</strong></td>
				<td align="center"><strong>FECHA VENCIMIENTO SOAT</strong></td>
				<td align="center"><strong>CDA TECNOMECANICA</strong></td>
				<td align="center"><strong>NRO POLIZA CDA</strong></td>
				<td align="center"><strong>FECHA VENCIMIENTO CDA TECNOMECANICA</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$veh = $resp[$i];
				$tipovehiculo = new TipoVehiculo('','','');
				$tipovehiculos = $tipovehiculo->buscarTipoVehiculo('id',$veh->tipo_vehiculo);
				$marca = new MarcaVehiculo('','','','');
				$marcaf = $marca->buscarMarcaVehiculo('id',$veh->marca);
				$linea = new LineaMarca('','','','','','');
				$lineaf = $linea->buscarLineaMarca('id',$veh->linea);
				$color = new Color('','','','');
				$colores = $color->buscarColor('id',$veh->color);
				$carroceria = new Carroceria('','','','');
				$carroceriaf = $carroceria->buscarCarroceria('id',$veh->carroceria);
				$semiremolque = new Semirremolque('','','','');
				$semiremolquef = $semiremolque->buscarSemirremolque('id',$veh->marca_semiremolque);				
				$personal= new Personal('','','','','','','','','','','','','','','','','','','','','','','');
				$propietario= $personal->buscarPersonal('id',$veh->propietario);
				$tenencia= $personal->buscarPersonal('id',$veh->tenencia);
				$conductor= $personal->buscarPersonal('id',$veh->conductor);
				$aseg_riesgo_mercancia= $personal->buscarPersonal('id',$veh->aseg_riesgo_mercancia);
				$aseg_soat= $personal->buscarPersonal('id',$veh->aseg_soat);
				$cda_tecnomecanica= $personal->buscarPersonal('id',$veh->cda_tecnomecanica);
				if($veh->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr align="left" class="TablaUsuarios">
							<td align="left">'.$veh->placa.'</td>
							<td align="left">'.$tipovehiculos[0]->nombre.'</td>
							<td align="left">'.$marcaf[0]->nombre.'</td>
							<td align="left">'.$lineaf[0]->nombre.'</td>
							<td align="left">'.$colores[0]->nombre.'</td>
							<td align="left">'.$carroceriaf[0]->nombre.'</td>
							<td align="left">'.$veh->peso_vacio.'</td>
							<td align="left">'.$veh->peso_maximo.'</td>
							<td align="left">'.$veh->capacidad.'</td>
							<td align="left">'.$veh->modelo.'</td>
							<td align="left">'.$veh->repotenciado.'</td>
							<td align="left">'.$veh->tipo_combustible.'</td>
							<td align="left">'.$veh->nro_motor.'</td>
							<td align="left">'.$veh->configuracion_ejes.'</td>
							<td align="left">'.$veh->tipo.'</td>
							<td align="left">'.$veh->placa_semiremolque.'</td>
							<td align="left">'.$semiremolquef[0]->nombre.'</td>
							<td align="left">'.$veh->reg_nal_carga.'</td>
							<td align="left">'.$propietario[0]->nombre1.' '.$propietario[0]->nombre2.' '.$propietario[0]->apellido1.' '.$propietario[0]->apellido2.'</td>
							<td align="left">'.$tenencia[0]->nombre1.' '.$tenencia[0]->nombre2.' '.$tenencia[0]->apellido1.' '.$tenencia[0]->apellido2.'</td>
							<td align="left">'.$conductor[0]->nombre1.' '.$conductor[0]->nombre2.' '.$conductor[0]->apellido1.' '.$conductor[0]->apellido2.'</td>
							<td align="left">'.$veh->celular.'</td>
							<td align="left">'.$aseg_riesgo_mercancia[0]->nombre1.' '.$aseg_riesgo_mercancia[0]->nombre2.' '.$aseg_riesgo_mercancia[0]->apellido1.' '.$aseg_riesgo_mercancia[0]->apellido2.'</td>
							<td align="left">'.$veh->nro_poliza_riesgo_mercancia.'</td>
							<td align="left">'.$veh->fecha_venc_riesgo_mercancia.'</td>
							<td align="left">'.$aseg_soat[0]->nombre1.' '.$aseg_soat[0]->nombre2.' '.$aseg_soat[0]->apellido1.' '.$aseg_soat[0]->apellido2.'</td>
							<td align="left">'.$veh->nro_poliza_soat.'</td>
							<td align="left">'.$veh->fecha_venc_soat.'</td>
							<td align="left">'.$cda_tecnomecanica[0]->nombre1.' '.$cda_tecnomecanica[0]->nombre2.' '.$cda_tecnomecanica[0]->apellido1.' '.$cda_tecnomecanica[0]->apellido2.'</td>
							<td align="left">'.$veh->nro_poliza_cda.'</td>
							<td align="left">'.$veh->fecha_venc_cda.'</td>
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
header("Content-Disposition: attachment; filename=Vehiculos.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>