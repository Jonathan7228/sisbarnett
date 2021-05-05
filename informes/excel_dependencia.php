<? 
session_start();
include_once '../clases/Dependencia.php';
$dependencia= new Dependencia('','','');
$resp=$dependencia->buscarDependencia('*','');
$excel = '<table>
			  <tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			  </tr>';
			for ($i=0; $i<count($resp); $i++){
				$dep = $resp[$i];
				if($dep->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$dep->id.'</td>
							<td align="left">'.$dep->nombre.'</td>
							<td>'.$estado.'</td>
					  </tr>';
			} 
$excel .= '</table>';	  
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Dependencias.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>