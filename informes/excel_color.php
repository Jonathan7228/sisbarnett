<?PHP
session_start();
include_once '../clases/Color.php';
$color= new Color('','','');
$resp=$color->buscarColor('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$colores = $resp[$i];
				if($colores->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$colores->codigo.'</td>
							<td align="left">'.$colores->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Colores.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>