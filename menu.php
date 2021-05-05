<?php 
session_start();
if($_SESSION["autenticated"] == 1){
$_SESSION['var1']='fondo_presentacion.php';

?>
<HTML>
<HEAD>
  <TITLE>Sistema Barnett</TITLE>

  <SCRIPT>
   function op() {
     // This function is for folders that do not open pages themselves.
     // See the online instructions for more information.
   }
  </SCRIPT>

 </HEAD>

 <!-- You may make other changes, but do not change the names  -->
 <!-- of the frames (treeframe and basefrm).                   -->

<FRAMESET ROWS=25%,100%>
<form action="" method="post" name="menu" id="menu" target="basefrm" enctype="multipart/form-data">
    <FRAME SRC="cabecera.php" scrolling="no"  noresize="noresize"></FRAME>
     <FRAMESET cols="250,*"  noresize="noresize">
          <FRAME src="menuarbol.php" name="treeframe" id="treeframe"  noresize="noresize" > 
          <FRAME src="fondo_presentacion.php" name="basefrm" noresize="noresize"> 
     </FRAMESET>
</form>
 </FRAMESET><noframes></noframes>

</HTML>

<?php 
}else{
	echo"<script language='javascript'>alert('No esta Autenticado, Verificar por favor!');</script>";
	echo '<script>window.location="index.php";</script>';

}

?>
