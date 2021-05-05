<? 
session_start();
include_once '../clases/PorcentajeComisionRecaudo.php';
include_once '../clases/TipoProducto.php';
include_once '../clases/TipoNegociacion.php';
include_once '../clases/TipoAsesor.php';
include_once '../clases/Regional.php';
include_once '../clases/Crm.php';
$resp=unserialize($_SESSION['porcentajes']);
//$persona= new Personal('','','','','','','','','','','','','','','','','','','','','','','');
//$resp=$persona->buscarPersonal('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>REGIONAL</strong></td>
				<td align="center"><strong>FECHA INICIO</strong></td>
				<td align="center"><strong>FECHA FIN</strong></td>
				<td align="center"><strong>TIPO ASESOR</strong></td>
				<td align="center"><strong>TIPO NEGOCIACION</strong></td>
				<td align="center"><strong>TIPO PRODUCTO</strong></td>
				<td align="center"><strong>TIPO CALCULO</strong></td>
				<td align="center"><strong>CRM</strong></td>
				<td align="center"><strong>PLAZO 1</strong></td>
				<td align="center"><strong>COMISION 1</strong></td>
				<td align="center"><strong>PLAZO 2</strong></td>
				<td align="center"><strong>COMISION 2</strong></td>
				<td align="center"><strong>PLAZO 3</strong></td>
				<td align="center"><strong>COMISION 3</strong></td>
				<td align="center"><strong>PLAZO 4</strong></td>
				<td align="center"><strong>COMISION 4</strong></td>
				<td align="center"><strong>PLAZO 5</strong></td>
				<td align="center"><strong>COMISION 5</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$porcen = $resp[$i];
				$tipoasesor = new TipoAsesor($porcen->id_tipoasesor,'','');
				$tipoasesores = $tipoasesor->buscarTipoAsesor();
				$crm = new Crm($porcen->id_crm,'','','','','','','','');
				$nomcrm = $crm->buscarCrm('id');
				$tipoProducto = new TipoProducto($porcen->id_tipoproducto,'','');
				$tipoProductos = $tipoProducto->buscarTipoProducto('id');
				$tipoNegociacion = new TipoNegociacion($porcen->id_tiponegociacion,'','','');
				$tipoNegociaciones = $tipoNegociacion->buscarTipoNegociacion('id');
				$regional= new Regional($porcen->id_regional,'','','');
				$regionales= $regional->buscarRegional(2);
				/*$obs = new Observacion('','',$perso->id,'','','');
				$observacion = $obs->buscarObservacion('id_otro','1');*/
				if($porcen->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				if($porcen->id_regional==0){
					$regional="TODAS LAS REGIONALES";
				}else{
					$regional=$regionales[0]->nombre;
				}
				$excel .= '<tr align="left" class="TablaUsuarios">
							<td>'.$regional.'</td>
							<td>'.$porcen->fecha_inicio.'</td>
							<td>'.$porcen->fecha_fin.'</td>
							<td>'.$tipoasesores[0]->nombre.'</td>
							<td>'.$tipoNegociaciones[0]->nombre.'</td>
							<td>'.$tipoProductos[0]->nombre.'</td>
							<td>'.$porcen->tipo_calculo.'</td>
							<td>'.$nomcrm[0]->nombre.'</td>
							<td>'.$porcen->plazo1.'</td>
							<td>'.$perso->comision1.'</td>
							<td>'.$porcen->plazo2.'</td>
							<td>'.$perso->comision2.'</td>
							<td>'.$porcen->plazo3.'</td>
							<td>'.$perso->comision3.'</td>
							<td>'.$porcen->plazo4.'</td>
							<td>'.$perso->comision4.'</td>
							<td>'.$porcen->plazo5.'</td>
							<td>'.$perso->comision5.'</td>
							<td>'.$estado.'</td>
						</tr>';
			} 
$excel .= '</table>';	  
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Porcentaje Comision por Recaudo.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>