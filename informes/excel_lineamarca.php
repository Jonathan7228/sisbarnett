<?PHP
session_start();
include_once '../clases/LineaMarca.php';
$lineamarca= new LineaMarca('','','');
$resp=$lineamarca->buscarLineaMarca('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>CODIGO DE LA MARCA</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$lineamarca = $resp[$i];
				if($lineamarca->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$lineamarca->codigo.'</td>
							<td align="center">'.$lineamarca->codigo_marca.'</td>
							<td align="left">'.$lineamarca->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Lineas de Marca.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>