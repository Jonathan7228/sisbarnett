<?PHP
session_start();
include_once '../clases/Tratamiento.php';
$resp= unserialize($_SESSION['tipoclientes']);
$excel = '<table border="1">
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$tipocliente = $resp[$i];
				if($tipocliente->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$tipocliente->id.'</td>
							<td align="left">'.$tipocliente->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Tipo Clientes.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>