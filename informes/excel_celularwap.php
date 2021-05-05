<? 
session_start();
include_once '../clases/CelularWap.php';
include_once '../clases/Ciudad.php';
$celular= new CelularWap('','','','','','');
$resp=$celular->buscarCelularWap($_POST['select'],$_POST['palabra']);
$excel = '<table>
			<tr>
				<td align="center"><strong>CIUDAD</strong></td>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>AREA</strong></td>
				<td align="center"><strong>IMEI</strong></td>
				<td align="center"><strong>NUMERO</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$cel = $resp[$i];
				$ciudad = new Ciudad($cel->id_ciudad,'','','');
				$ciudades = $ciudad->buscarCiudad();
				if($cel->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr align="left" class="TablaUsuarios">
							<td align="center">'.$ciudades[0]->nombre.'</td>
							<td align="center">'.$cel->codigo.'</td>
							<td>'.$cel->area.'</td>
							<td>'.$cel->imei.'</td>
							<td>'.$cel->numero.'</td>
							<td align="left" valign="middle">'.$estado.'</td>
					  </tr>';
					} 
$excel .= '</table>';	  
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Celulares Wap.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>