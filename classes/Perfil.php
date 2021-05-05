<?php
include_once '../conexion/Conexion.php';

class Perfil{
	
	public $id;
	public $nombre;
	public $descripcion;
	public $gd_digitalizar_doc;
	
	public $gd_ver_doc;
	public $gd_ver_egresos;
	public $gd_ver_correspondenciaEPS;
	public $gd_ver_notas_credito;
	public $gd_ver_notas_debito;
	public $gd_ver_recibos_caja;
	public $gd_ver_indirectos;
	public $gd_ver_acuerdos_com;
	public $gd_ver_mvtos_cont;
	public $gd_ver_sol_credito;
	public $gd_ver_hojas_vida;
	
	public $gd_editar_doc;
	public $gd_ver_guia;
	public $gd_eliminar_guia;
	
	public $admin_crear_usuario;
	public $admin_editar_usuario;
	public $admin_actdes_usuario;
	public $admin_crear_perfil;
	public $admin_editar_perfil;
	public $admin_ver_perfil;
	
	public $sb_correo_cliente;
	public $sb_debito_auto;
	public $sb_resp_debito_auto;
	
	public $mtros_crear_vehiculo;
	public $mtros_editar_vehiculo;
	public $mtros_ver_vehiculo;
		
	public $mtros_crear_personal;
	public $mtros_editar_personal;
	public $mtros_ver_personal;
	
	public $prod_vehiculo_varados;
	
	public $estado;
	
	function Perfil(
				$id="",
				$nombre="",
				$descripcion="",
				$gd_digitalizar_doc="",
				$gd_ver_doc="",
				$gd_ver_egresos="",
				$gd_ver_correspondenciaEPS="",
				$gd_ver_notas_credito="",
				$gd_ver_notas_debito="",
				$gd_ver_recibos_caja="",
				$gd_ver_indirectos="",
				$gd_ver_acuerdos_com="",
				$gd_ver_mvtos_cont="",
				$gd_ver_sol_credito="",
				$gd_ver_hojas_vida="",       
				$gd_editar_doc="",
				$gd_ver_guia="",
				$gd_eliminar_guia="",
				$admin_crear_usuario="",
				$admin_editar_usuario="",
				$admin_actdes_usuario="",
				$admin_crear_perfil="",
				$admin_editar_perfil="",
				$admin_ver_perfil="",
				$sb_correo_cliente="",
				$sb_debito_auto="",
				$sb_resp_debito_auto="",
				$mtros_crear_vehiculo="",
				$mtros_editar_vehiculo="",
				$mtros_ver_vehiculo="",	
				$mtros_crear_personal="",
				$mtros_editar_personal="",
				$mtros_ver_personal="",
				$prod_vehiculo_varados="", 
				$estado=""){
					
		$this->id=$id;
		$this->nombre=$nombre;
		$this->descripcion=$descripcion;
		$this->gd_digitalizar_doc=$gd_digitalizar_doc;
		
		$this->gd_ver_doc=$gd_ver_doc;
		$this->gd_ver_egresos=$gd_ver_egresos;
		$this->gd_ver_correspondenciaEPS=$gd_ver_correspondenciaEPS;
		$this->gd_ver_notas_credito=$gd_ver_notas_credito;
		$this->gd_ver_notas_debito=$gd_ver_notas_debito;
		$this->gd_ver_recibos_caja=$gd_ver_recibos_caja;
		$this->gd_ver_indirectos=$gd_ver_indirectos;
		$this->gd_ver_acuerdos_com=$gd_ver_acuerdos_com;
		$this->gd_ver_mvtos_cont=$gd_ver_mvtos_cont;
		$this->gd_ver_sol_credito=$gd_ver_sol_credito;
		$this->gd_ver_hojas_vida=$gd_ver_hojas_vida;
		
		$this->gd_editar_doc=$gd_editar_doc;
		$this->gd_ver_guia=$gd_ver_guia;
		$this->gd_eliminar_guia=$gd_eliminar_guia;
		
		$this->admin_crear_usuario=$admin_crear_usuario;
		$this->admin_editar_usuario=$admin_editar_usuario;
		$this->admin_actdes_usuario=$admin_actdes_usuario;
		
		$this->admin_crear_perfil=$admin_crear_perfil;
		$this->admin_editar_perfil=$admin_editar_perfil;
		$this->admin_ver_perfil=$admin_ver_perfil;
		
		$this->sb_correo_cliente=$sb_correo_cliente;
		$this->sb_debito_auto=$sb_debito_auto;
		$this->sb_resp_debito_auto=$sb_resp_debito_auto;
		
		$this->mtros_crear_vehiculo=$mtros_crear_vehiculo;
		$this->mtros_editar_vehiculo=$mtros_editar_vehiculo;
		$this->mtros_ver_vehiculo=$mtros_ver_vehiculo;
		
		$this->mtros_crear_personal=$mtros_crear_personal;
		$this->mtros_editar_personal=$mtros_editar_personal;
		$this->mtros_ver_personal=$mtros_ver_personal;
		
		$this->prod_vehiculo_varados=$prod_vehiculo_varados;
		
		
		$this->estado=$estado;
	}
	
	function guardarPerfil(){
		$conn = new Conexion();
		$conn->conectar();
		$sql = 'INSERT INTO tbl_perfiles SET 
				id="",
				nombre="'.$this->nombre.'",
				descripcion="'.$this->descripcion.'", 
				gd_digitalizar_doc="'.$this->gd_digitalizar_doc.'", 
				gd_ver_doc="'.$this->gd_ver_doc.'", 
				gd_ver_egresos="'.$this->gd_ver_egresos.'",
				gd_ver_correspondenciaEPS="'.$this->gd_ver_correspondenciaEPS.'",
				gd_ver_notas_credito="'.$this->gd_ver_notas_credito.'",
				gd_ver_notas_debito="'.$this->gd_ver_notas_debito.'",
				gd_ver_recibos_caja="'.$this->gd_ver_recibos_caja.'",
				gd_ver_indirectos="'.$this->gd_ver_indirectos.'",
				gd_ver_acuerdos_com="'.$this->gd_ver_acuerdos_com.'",
				gd_ver_mvtos_cont="'.$this->gd_ver_mvtos_cont.'",
				gd_ver_sol_credito="'.$this->gd_ver_sol_credito.'",
				gd_ver_hojas_vida="'.$this->gd_ver_hojas_vida.'", 
				gd_editar_doc="'.$this->gd_editar_doc.'",
				gd_ver_guia="'.$this->gd_ver_guia.'", 
				gd_eliminar_guia="'.$this->gd_eliminar_guia.'",
				admin_crear_usuario="'.$this->admin_crear_usuario.'",
				admin_editar_usuario="'.$this->admin_editar_usuario.'",
				admin_actdes_usuario="'.$this->admin_actdes_usuario.'",
				admin_crear_perfil="'.$this->admin_crear_perfil.'",
				admin_editar_perfil="'.$this->admin_editar_perfil.'",
				admin_ver_perfil="'.$this->admin_ver_perfil.'",
				sb_debito_auto="'.$this->sb_debito_auto.'",
				sb_resp_debito_auto="'.$this->sb_resp_debito_auto.'",
				
				mtros_crear_vehiculo="'.$this->mtros_crear_vehiculo.'",
				mtros_editar_vehiculo="'.$this->mtros_editar_vehiculo.'",
				mtros_ver_vehiculo="'.$this->mtros_ver_vehiculo.'",
				mtros_crear_personal="'.$this->mtros_crear_personal.'",
				mtros_editar_personal="'.$this->mtros_editar_personal.'",
				mtros_ver_personal="'.$this->mtros_ver_personal.'",
				
				prod_vehiculo_varados="'.$this->prod_vehiculo_varados.'",
				estado="1" ';
		//echo "<BR>SQL: ".$sql;
		$resp = $conn->consultar($sql);
		$conn->liberarConsulta();
		$conn->desconectar();
		return $resp;
	}
	
	public function editarPerfil(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tbl_perfiles set  
				nombre="'.$this->nombre.'",
				descripcion="'.$this->descripcion.'", 
				gd_digitalizar_doc="'.$this->gd_digitalizar_doc.'", 
				gd_ver_doc="'.$this->gd_ver_doc.'", 
				gd_ver_egresos="'.$this->gd_ver_egresos.'",
				gd_ver_correspondenciaEPS="'.$this->gd_ver_correspondenciaEPS.'",
				gd_ver_notas_credito="'.$this->gd_ver_notas_credito.'",
				gd_ver_notas_debito="'.$this->gd_ver_notas_debito.'",
				gd_ver_recibos_caja="'.$this->gd_ver_recibos_caja.'",
				gd_ver_indirectos="'.$this->gd_ver_indirectos.'",
				gd_ver_acuerdos_com="'.$this->gd_ver_acuerdos_com.'",
				gd_ver_mvtos_cont="'.$this->gd_ver_mvtos_cont.'",
				gd_ver_sol_credito="'.$this->gd_ver_sol_credito.'",
				gd_ver_hojas_vida="'.$this->gd_ver_hojas_vida.'", 
				gd_editar_doc="'.$this->gd_editar_doc.'",
				gd_ver_guia="'.$this->gd_ver_guia.'", 
				gd_eliminar_guia="'.$this->gd_eliminar_guia.'",
				admin_crear_usuario="'.$this->admin_crear_usuario.'",
				admin_editar_usuario="'.$this->admin_editar_usuario.'",
				admin_actdes_usuario="'.$this->admin_actdes_usuario.'",
				admin_crear_perfil="'.$this->admin_crear_perfil.'",
				admin_editar_perfil="'.$this->admin_editar_perfil.'",
				admin_ver_perfil="'.$this->admin_ver_perfil.'",
				sb_debito_auto="'.$this->sb_debito_auto.'",
				sb_debito_auto="'.$this->sb_debito_auto.'",
				sb_resp_debito_auto="'.$this->sb_resp_debito_auto.'",
				mtros_crear_vehiculo="'.$this->mtros_crear_vehiculo.'",
				mtros_editar_vehiculo="'.$this->mtros_editar_vehiculo.'",
				mtros_ver_vehiculo="'.$this->mtros_ver_vehiculo.'",
				mtros_crear_personal="'.$this->mtros_crear_personal.'",
				mtros_editar_personal="'.$this->mtros_editar_personal.'",
				mtros_ver_personal="'.$this->mtros_ver_personal.'",
				prod_vehiculo_varados="'.$this->prod_vehiculo_varados.'"
				WHERE 
				id="'.$this->id.'"';
		//echo $sql;
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
	
	public function existePerfil(){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= "select * from tbl_perfiles where nombre='".$this->nombre."'";
		$consul=$con->consultar($sql);
		$num_rows = mysql_num_rows($consul);
		$con->liberarConsulta();
		$con->desconectar();
		return $num_rows;
	}
	
	function buscarPerfil($select,$palabra){
		$conn = new Conexion();
		$conn->conectar();
		if($select=='nombre'){
			$sql = "SELECT * from tbl_perfiles WHERE nombre = '".$palabra."'";
		}else if($select=='id'){
			$sql = "SELECT * from tbl_perfiles WHERE id = '".$palabra."'";
		}else{
			$sql = "SELECT * from tbl_perfiles WHERE estado=1";
		}
		//echo "<BR>SQL: ".$sql;	
		$perfiles = array();
		$cont = 0;
		$resp = $conn->consultar($sql);
		while ($datos = @mysql_fetch_array($resp)){
			$perfiles[$cont] = new Perfil(
										$datos['id'],
										$datos['nombre'],
										$datos['descripcion'],
										$datos['gd_digitalizar_doc'],
										$datos['gd_ver_doc'],
										$datos['gd_ver_egresos'],
										$datos['gd_ver_correspondenciaEPS'],
										$datos['gd_ver_notas_credito'],
										$datos['gd_ver_notas_debito'],
										$datos['gd_ver_recibos_caja'],
										$datos['gd_ver_indirectos'],
										$datos['gd_ver_acuerdos_com'],
										$datos['gd_ver_mvtos_cont'],
										$datos['gd_ver_sol_credito'],
										$datos['gd_ver_hojas_vida'],
										$datos['gd_editar_doc'],
										$datos['gd_ver_guia'],
										$datos['gd_eliminar_guia'],
										$datos['admin_crear_usuario'],
										$datos['admin_editar_usuario'],
										$datos['admin_actdes_usuario'],
										$datos['admin_crear_perfil'],
										$datos['admin_editar_perfil'],
										$datos['admin_ver_perfil'],
										$datos['sb_correo_cliente'],
										$datos['sb_debito_auto'],
										$datos['sb_resp_debito_auto'],
										$datos['mtros_crear_vehiculo'],
										$datos['mtros_editar_vehiculo'],
										$datos['mtros_ver_vehiculo'],
										$datos['mtros_crear_personal'],
										$datos['mtros_editar_personal'],
										$datos['mtros_ver_personal'],
										$datos['prod_vehiculo_varados'], 
										$datos['estado']);
			$cont++;
		}
		$conn->liberarConsulta();
		$conn->desconectar();
		return $perfiles;
	}
	
	
	public function activarDesactivarPerfil($valor){
		$con= new Conexion();
		$conectar=$con->conectar();
		$sql= 'UPDATE tbl_perfiles set estado="'.$valor.'" where id="'.$this->id.'"';
		$consul=$con->consultar($sql);
		$con->liberarConsulta();
		$con->desconectar();
		return $consul;
	}
}
?>