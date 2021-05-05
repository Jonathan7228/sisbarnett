<?php
class Connection{
	
	/*public $ubicacion_servidor="10.1.1.10";
	public $puerto='3306';
	public $login="sisafusr";
	public $password="S1s4721$";
	public $nombre_bd="sisaf";*/
	public $location_server="localhost";
	public $port='3306';
	public $login="root";
	public $password="";
	public $name_bd="db_sisbarnett";
	public $answer;
	public $conn;
	
	function Connection(){
	}
	
	function connect(){
		$this->conn = @mysql_connect($this->location_server,$this->login,$this->password);
		@mysql_select_db($this->name_bd, $this->conn); 
	}
	
	function disconnect(){
		@mysql_close($this->conn);
	}
	//Instruction for cleaner cache memory in mysql
	function cleanQuery(){
    	@mysql_free_result($this->answer);
  	}
	
	function query($ssql){
		$this->answer = @mysql_query($ssql); 
		return $this->answer;
	}

}
?>