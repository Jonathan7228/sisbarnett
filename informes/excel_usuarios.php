<? 
session_start();
include_once '../clases/Usuario.php';
$resp=unserialize($_SESSION['usuarios']);
$excel = '<table border="1">
			<tr>
				<td align="center"><strong>DOCUMENTO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>CORREO</strong></td>
				<td align="center"><strong>PERFIL</strong></td>
				<td align="center"><strong>FECHA CREACION</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$usu = $resp[$i];
				if($usu->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr align="left" class="TablaUsuarios">
							<td>'.$usu->documento.'</td>
							<td>'.$usu->nombre.'</td>
							<td>'.$usu->correo.'</td>
							<td>'.$usu->perfil.'</td>
							<td>'.$usu->fecha_creacion.'</td>
							<td>'.$estado.'</td>
						</tr>';
			} 
$excel .= '</table>';	  
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Usuarios.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>