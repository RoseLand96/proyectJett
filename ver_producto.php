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

$varProducto_DatosProducto = "0";
if (isset($_GET["recordID"])) {
  $varProducto_DatosProducto = $_GET["recordID"];
}
mysql_select_db($database_connectionBuyo, $connectionBuyo);
$query_DatosProducto = sprintf("SELECT * FROM categoria, productos WHERE productos.ID_producto=%s", GetSQLValueString($varProducto_DatosProducto, "int"));
$DatosProducto = mysql_query($query_DatosProducto, $connectionBuyo) or die(mysql_error());
$row_DatosProducto = mysql_fetch_assoc($DatosProducto);
$totalRows_DatosProducto = mysql_num_rows($DatosProducto);
?>
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
                <h1><!-- InstanceBeginEditable name="titulo" --><?php echo $row_DatosProducto['Nbre_producto']; ?><!-- InstanceEndEditable --></h1>
                <!-- InstanceBeginEditable name="EditRegion4" -->
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="500"><img src="documentos/productos/<?php echo $row_DatosProducto['strImagen']; ?>" width="350" height="250" /></td>
                    <td width="351" valign="top"><p>         <?php echo $row_DatosProducto['Nbre_producto']; ?></p>
                    <p>$ <?php echo $row_DatosProducto['Precio']; ?></p>
                  
                  <?php if ( (isset ($_SESSION['MM_ID_usuario'])) && ( $_SESSION['MM_ID_usuario']!="")) {?>
                  <p><a href="carrito_add.php?recordID=<?php echo $row_DatosProducto['ID_producto']; ?>">Comprar</a></p>
                 <?php } 
				 else
				 {?>
                 Hola! Para comprar, Ingresa tu e-mail y clave <a href="compra_acceso.php">Ingresar</a> O
                  <a href="alta_usuario.php">Crear cuenta</a> .
<?php } ?>
                 
                 </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
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
mysql_free_result($DatosProducto);
?>
