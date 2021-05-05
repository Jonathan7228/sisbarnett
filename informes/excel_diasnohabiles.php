<?PHP 
session_start();
include_once '../clases/DiaNoHabil.php';
$resp=unserialize($_SESSION['fechas']);
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>FECHA</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$fecha = $resp[$i];
				$excel .= '<tr>
							<td align="center">'.$fecha->id.'</td>
							<td align="left">'.$fecha->fecha.'</td>
							<td align="left">'.$fecha->estado.'</td>
						  </tr>';
			} 
$excel .= '</table>'; 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Dias No Habiles.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>