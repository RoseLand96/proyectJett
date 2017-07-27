<?php require_once('Connections/connectionBuyo.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$varUsuario_DatosCompra = "0";
if (isset($_SESSION["MM_ID_usuario"])) {
  $varUsuario_DatosCompra = $_SESSION["MM_ID_usuario"];
}
mysql_select_db($database_connectionBuyo, $connectionBuyo);
$query_DatosCompra = sprintf("SELECT * FROM tblcompra WHERE tblcompra.ID_usuario = %s ORDER BY tblcompra.idCompra DESC", GetSQLValueString($varUsuario_DatosCompra, "int"));
$DatosCompra = mysql_query($query_DatosCompra, $connectionBuyo) or die(mysql_error());
$row_DatosCompra = mysql_fetch_assoc($DatosCompra);
$totalRows_DatosCompra = mysql_num_rows($DatosCompra);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Welcome to BUY'O</title>
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
                <h1><!-- InstanceBeginEditable name="titulo" -->Mis compras<!-- InstanceEndEditable --></h1>
                <!-- InstanceBeginEditable name="EditRegion4" -->
                                <?php if ($totalRows_DatosCompra > 0) { // Show if recordset not empty ?>
      
                <table width="100%%" border="0" cellspacing="3" cellpadding="3">
                  <tr>
                  <td bgcolor="#FFFF00">N° Compra</td>
                    <td bgcolor="#FFFF00">Producto</td>
                    <td bgcolor="#FFFF00">Fecha</td>
                    <td bgcolor="#FFFF00">Total</td>
                    <td bgcolor="#FFFF00">Estado</td>
                  </tr>
                  
                    <?php do { ?><tr>
                    <td><?php echo $row_DatosCompra['idCompra']; ?></td>
                    <td><?php Mostrar_Carrito_Usuario($row_DatosCompra['idCompra']);?></td>
                    <td><?php echo $row_DatosCompra['fchcompra']; ?></td>
                    <td>$ <?php echo $row_DatosCompra['dblTotal']; ?></td>
                    <td><?php echo TextoEstadoCompra($row_DatosCompra['intEstado']); ?></td>
                    </tr>  <?php } while ($row_DatosCompra = mysql_fetch_assoc($DatosCompra)); ?>
                  
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                  <?php } // Show if recordset not empty ?>
                  <?php if ($totalRows_DatosCompra == 0) { // Show if recordset empty ?>
                    No has realizado ningun compra en BUY'O.
  <?php } // Show if recordset empty ?>
                <!-- InstanceEndEditable -->
      <!-- end .content --></div>
    <!-- end .subcontenedor --></div>
  <div class="footer">
    <p>Pied de pagina</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($DatosCompra);
?>
