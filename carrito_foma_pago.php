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
                <h1><!-- InstanceBeginEditable name="titulo" --><!-- InstanceEndEditable --></h1>
                <!-- InstanceBeginEditable name="EditRegion4" -->
                
                <form id="form1" name="form1" method="post" action="carrito_finalizacion.php">
                  
                  <h2>Elije la forma de pago:</h2>
                  <table width="100%%" border="0" cellspacing="3" cellpadding="3">
                    <tr>
                      <td width="47%">PayPal</td>
                      <td width="53%"><input name="radio" type="radio" id="radio2" value="1" checked="checked" /></td>
                    </tr>
                    <tr>
                      <td>Transferencia</td>
                      <td><input type="radio" name="radio" id="radio3" value="2" /></td>
                    </tr>
                    <tr>
                      <td>VISA/Mastercard</td>
                      <td><input type="radio" name="radio" id="radio" value="3" /></td>
                    </tr>
                  </table>
                
                    <input type="submit" name="button" id="button" value="Pagar" />
               
            
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
