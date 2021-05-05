<? 
session_start();
include_once '../clases/PresupuestoVenta.php';
include_once '../clases/Regional.php';
$resp=unserialize($_SESSION['presupuestos']);
$excel = '<table>
			<tr>
				<td align="center"><strong>SUCURSAL (REGIONAL)</strong></td>
				<td align="center"><strong>MES</strong></td>
				<td align="center"><strong>VALOR PRESUPUESTO GENERAL MES</strong></td>
				<td align="center"><strong>NRO UNIDADES GENERAL MES</strong></td>
				<td align="center"><strong>VALOR PRESUPUESTO CONTRADO MES</strong></td>
				<td align="center"><strong>NRO UNIDADES CONTRADO MES</strong></td>
				<td align="center"><strong>VALOR PRESUPUESTO CONTRAENTREGA MES</strong></td>
				<td align="center"><strong>NRO UNIDADES CONTRAENTREGA MES</strong></td>
				<td align="center"><strong>VALOR PRESUPUESTO CREDITO MES</strong></td>
				<td align="center"><strong>NRO UNIDADES CREDITO MES</strong></td>
				<td align="center"><strong>NRO DIAS ACOMULADOS MES</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$pres = $resp[$i];
				$regional = new Regional($pres->id_regional,'','','');
				$regionales = $regional->buscarRegional(2);
				if($pres->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr align="left" class="TablaUsuarios">
							<td>'.$regionales[0]->nombre.'</td>
							<td>'.$pres->mes.'</td>
							<td>'.$pres->vlorgralmes.'</td>
							<td>'.$pres->nrounigralmes.'</td>
							<td>'.$pres->vlorcontmes.'</td>
							<td>'.$pres->nrouncontmes.'</td>
							<td>'.$pres->vlorcentmes.'</td>
							<td>'.$pres->nrounicentmes.'</td>
							<td>'.$pres->vlorcredmes.'</td>
							<td>'.$pres->nrounicredmes.'</td>
							<td>'.$pres->nrodiasacummes.'</td>
							<td align="center">'.$estado.'</td>
						</tr>';
			} 
$excel .= '</table>';	  
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Presupuesto Ventas.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>