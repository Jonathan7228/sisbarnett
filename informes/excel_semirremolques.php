<?PHP
session_start();
include_once '../clases/Semirremolque.php';
$semirremolque= new Semirremolque('','','');
$resp=$semirremolque->buscarSemirremolque('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$semirremolque = $resp[$i];
				if($semirremolque->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$semirremolque->codigo.'</td>
							<td align="left">'.$semirremolque->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Semirremolques.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>