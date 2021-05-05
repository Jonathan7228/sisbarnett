<?php
 //crear y destruir session 
 session_start(); 
 // vaciarla 
 $_SESSION = array(); 
 // destruirla 
 session_destroy(); 
  
 echo"<script language='javascript'>top.location.href = 'index.php';</script>";
?>