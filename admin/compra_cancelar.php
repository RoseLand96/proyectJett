<?php require_once('../Connections/connectionBuyo.php'); ?>
<?php ActualizacionEstadoCarrito($_GET["recordID"],2);?>
           <?php
				 $contenido = 'Hola xxxxxxx;<br><br><p>Tu Compra ha sido cancelada.
				 contacta con nosotros para cualquier problema</p>';
				 	 $asunto = 'Compra Cancelada en buyo.com';
                EnvioCorreoHTML(ObtenerMailUsario($_GET['usuario']),$contenido, $asunto)
                ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Baseadmin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-l" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Administration Buy'O</title>
<!-- InstanceEndEditable -->
<link href="../estilo/estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>

<div class="container">
  <div class="header"><img src="../images/image1.png" width="149" height="90" alt="logo" />

    <!-- end .header --></div>
  <div class="sidebar1">
  <?php include("../includes/cabeceraadmin.php");
  ?>
  
   <!-- end .sidebar1 --></div>
  <div class="content"><!-- InstanceBeginEditable name="EditRegion1" -->
  <h1>Compra Cancelada</h1>
  <p><a href="compras_edit.php?recordID=<?php echo $_GET["recordID"];?>">Volver</a></p>
  
  
  <!-- InstanceEndEditable -->
   
    
    <!-- end .content --></div>
  <div class="footer">
    <p>Administration Buy'O</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>