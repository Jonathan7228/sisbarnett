<?PHP 
session_start();
include_once '../clases/FechaCorte.php';
$fechacorte= new FechaCorte('','','');
$resp=$fechacorte->buscarFechaCorte('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>FECHA</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$fecha = $resp[$i];
				$excel .= '<tr>
							<td align="center">'.$fecha->id.'</td>
							<td align="left">'.$fecha->fecha.'</td>
						  </tr>';
			} 
$excel .= '</table>'; 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Fechas de Corte.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>