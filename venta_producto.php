<?php require_once('Connections/connectionBuyo.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Documento sin título</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="estilo/principal.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="container">
  <div class="header">
    <div class="headerinterior"><a href="index.php"><img src="images/image1.png" width="110" height="50" alt="logo" /></a>
    <?php include("includes/catalogo2.php"); ?>
    </div>
    </div>
     
  <div class="subcontenedor">
              <div class="sidebar1">
              <?php include("includes/catalogo.php"); ?>
              
              <!-- end .sidebar1 --></div>
    <div class="content">
      <h1><!-- InstanceBeginEditable name="titulo" -->      <!-- InstanceEndEditable --></h1>
                <!-- InstanceBeginEditable name="EditRegion4" -->
                 <form action="admin/producto_add.php" method="POST">
                   <?php if ( (isset ($_SESSION['MM_ID_usuario'])) && ( $_SESSION['MM_ID_usuario']!="")) {?>
                  
                Ya puedes vender cualquier producto legal en este sitio, para iniciar dar clic en el button
 <input type="submit" value="vender producto" />
  <?php } 
  
 else
 {?>
Para Vender un producto en este sitio, es necesario, <a href="venta_acceso.php">Ingresar</a>  tu e-mail y clave <a href="acceso.php"></a> O <a href="venta_alta_usuario.php">Crear una cuenta</a> .
<?php } ?>
   </form>            
                <!-- InstanceEndEditable -->
      <!-- end .content --></div>
    <!-- end .subcontenedor --></div>
  <div class="footer">
    <p>Pied de pagina</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>

