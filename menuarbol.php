<?php session_start(); ?>
<HTML>

<!--------------------------------------------------------------->
<!-- Copyright (c) 2006 by Conor O'Mahony.                     -->
<!-- For enquiries, please email GubuSoft@GubuSoft.com.        -->
<!-- Please keep all copyright notices below.                  -->
<!-- Original author of TreeView script is Marcelino Martins.  -->
<!--------------------------------------------------------------->
<!-- This document includes the TreeView script.  The TreeView -->
<!-- script can be found at http://www.TreeView.net.  The      -->
<!-- script is Copyright (c) 2006 by Conor O'Mahony.           -->
<!--------------------------------------------------------------->
<!-- Instructions:                                             -->
<!--   - Through the <STYLE> tag you can change the colors and -->
<!--     types of fonts to the particular needs of your site.  -->
<!--   - A predefined block with black background has been     -->
<!--     made for stylish people :-)                           -->
<!--------------------------------------------------------------->

 <HEAD>

  <!-- This is the <STYLE> block for the default styles.  If   -->
  <!-- you want the black background, remove this <STYLE>      -->
  <!-- block.                                                  -->
  <STYLE>
    BODY {
      background-color: white;}
    TD {
      font-size: 10pt; 
      font-family: verdana,helvetica; 
      text-decoration: none;
      white-space:nowrap;}
    A {
      text-decoration: none;
      color: black;}
    .specialClass {
      font-family:garamond; 
      font-size:12pt;
      color:green;
      font-weight:bold;
      text-decoration:underline}
  </STYLE>

  <!-- If you want the black background, replace the contents  -->
  <!-- of the <STYLE> tag above with the following...
    BODY {
      background-color: black;}
    TD {
      font-size: 10pt; 
      font-family: verdana,helvetica; 
      text-decoration: none;
      white-space:nowrap;}
    A {
      text-decoration: none;
      color: white;}
  <!-- This is the end of the <STYLE> contents.                -->
 
  <!-- Code for browser detection. DO NOT REMOVE.              -->
  <SCRIPT src="js/ua.js"></SCRIPT>

  <!-- Infrastructure code for the TreeView. DO NOT REMOVE.    -->
  <SCRIPT src="js/ftiens4.js"></SCRIPT>

  <!-- Scripts that define the tree. DO NOT REMOVE.            -->

		<?php if(empty($_SESSION['bloqueo'])){ 
				echo '<SCRIPT src="js/menuprincipal.js"></SCRIPT>';
				 } else {
				echo '<SCRIPT src="js/menuprincipalbloqueado.js"></SCRIPT>';	 
          
          }?>
  <script> 
	var miPopup 
	function VentanaNueva(){ 
		miPopup = window.open("menu.php","popup","width=1200,height=700,menubar=no,toolbar=no,scrollbars=yes,directories=no,location=no") 
		miPopup.focus(); 
	}
</script>
 </HEAD>

<BODY topmargin="16" marginheight="16" <?php if(!empty($_SESSION['bloqueo'])){  echo ' style=" color:#666 ;opacity: .5; "'; } ?> >

  <!------------------------------------------------------------->
  <!-- IMPORTANT NOTICE:                                       -->
  <!-- Removing the following link will prevent this script    -->
  <!-- from working.  Unless you purchase the registered       -->
  <!-- version of TreeView, you must include this link.        -->
  <!-- If you make any unauthorized changes to the following   -->
  <!-- code, you will violate the user agreement.  If you want -->
  <!-- to remove the link, see the online FAQ for instructions -->
  <!-- on how to obtain a version without the link.            -->
  <!------------------------------------------------------------->
  <DIV style="position:absolute; top:0; left:0;"><TABLE border=0><TR><TD><FONT size=-2><A style="font-size:7pt;text-decoration:none;color:silver" href="http://www.treemenu.net/" target=_blank></A></FONT></TD></TR></TABLE></DIV>

  <!-- Build the browser's objects and display default view  -->
  <!-- of the tree.                                          -->

<img src="img/nuevasesion2.png" width="40" height="30" title="Nueva Ventana" onClick="javascript:VentanaNueva();">
<SCRIPT>initializeDocument();</SCRIPT>
</BODY>

</HTML>