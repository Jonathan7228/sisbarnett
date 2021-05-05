<?PHP
session_start();
include_once '../clases/Zona.php';
$zona= new Zona('','','');
$resp=$zona->buscarZona('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>REGIONAL</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ENTREGA EL MISMO DIA</strong></td>
				<td align="center"><strong>TRAYECTO</strong></td>
				<td align="center"><strong>PERMITE MODIFICAR RUTA</strong></td>
				<td align="center"><strong>PAGA UNIDADES MOVIDAS</strong></td>
				<td align="center"><strong>ES ALMACEN DE CADENA</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$zon = $resp[$i];
				if($zon->entrega_mismo_dia==1){
					$entrega_mismo_dia="SI";
				}else{
					$entrega_mismo_dia="NO";
				}
				
				if($zon->mod_ruta==1){
					$mod_ruta="SI";
				}else{
					$mod_ruta="NO";
				}
				
				if($zon->un_movidas==1){
					$un_movidas="SI";
				}else{
					$un_movidas="NO";
				}
				
				if($zon->alma_cadena==1){
					$alma_cadena="SI";
				}else{
					$alma_cadena="NO";
				}
				
				if($zon->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$zon->codigo.'</td>
							<td align="left">'.$zon->regional.'</td>
							<td align="left">'.$zon->nombre.'</td>
							<td align="left">'.$entrega_mismo_dia.'</td>
							<td align="left">'.$zon->trayecto.'</td>
							<td align="left">'.$mod_ruta.'</td>
							<td align="left">'.$un_movidas.'</td>
							<td align="left">'.$alma_cadena.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Zonas.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>