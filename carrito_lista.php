<?php require_once('Connections/connectionBuyo.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "usuario_sesion_caducada.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$varUsuario_Datoscarrito = "0";
if (isset($_SESSION["MM_ID_usuario"])) {
  $varUsuario_Datoscarrito = $_SESSION["MM_ID_usuario"];
}
mysql_select_db($database_connectionBuyo, $connectionBuyo);
$query_Datoscarrito = sprintf("SELECT * FROM carrito WHERE carrito.ID_usuario=%s AND carrito.intTransaccionEfectuada=0", GetSQLValueString($varUsuario_Datoscarrito, "int"));
$Datoscarrito = mysql_query($query_Datoscarrito, $connectionBuyo) or die(mysql_error());
$row_Datoscarrito = mysql_fetch_assoc($Datoscarrito);
$totalRows_Datoscarrito = mysql_num_rows($Datoscarrito);
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
                <h1><!-- InstanceBeginEditable name="titulo" -->Carrito de la compra<!-- InstanceEndEditable --></h1>
                <!-- InstanceBeginEditable name="EditRegion4" -->
                <script>
function asegurar()
{
	rc = confirm("¿Seguro que desea eliminar esta producto?");
	return rc;

}
</script>
                <?php if ($totalRows_Datoscarrito > 0) { // Show if recordset not empty ?>
                    <a href="carrito_eliminar_todo.php" onclick="javascript:return asegurar();">Vaciar Carrito</a>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td>Producto</td>
      <td>Unidades    </td>
      <td>Precio</td>
      <td>Acciones</td>
    </tr>
    <?php $preciototal = 0;?>
    <?php do { ?>
      <tr>
        <td><?php echo ObtenerNombreProducto ($row_Datoscarrito['idProducto']); ?></td>
        <td><?php echo  $row_Datoscarrito['intCantidad']; ?></td>
        <td><?php echo ObtenerPrecioProducto ($row_Datoscarrito['idProducto']); ?> $</td>
        
        
        
        
        
        
        <td><a href="carrito_eliminar.php?recordID=<?php echo $row_Datoscarrito['intContador']; ?>"onclick="javascript:return asegurar();">Eliminar</a></td>
      </tr>
      <?php $preciototal = $preciototal + ObtenerPrecioProducto ($row_Datoscarrito['idProducto']); ?>
      
      <?php } while ($row_Datoscarrito = mysql_fetch_assoc($Datoscarrito)); ?>
    <tr>
      <td>&nbsp;</td>
      <td align="right">SubTotal:</td>
      <td><?php echo $preciototal; ?> $</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right">IVA:</td>
      <td><?php echo ObtenerIVA(); ?>%</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right">Valor del IVA:</td>
      <td><?php
	  $multiplicador = (0 + ObtenerIVA())/100;
	   $valorconIVA = $preciototal * $multiplicador;
	   echo $valorconIVA?> $</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right">Total con IVA:</td>
      <td><?php
	  $multiplicador = (100 + ObtenerIVA())/100;
	   $valorconIVA = $preciototal * $multiplicador;
	   $_SESSION["Totalcompra"] = $valorconIVA;
	   echo $valorconIVA;?> $</td>
      <td>&nbsp;</td>
    </tr>
</table>
                <a href="carrito_foma_pago.php">Forma de Pago</a>
                  <?php } // Show if recordset not empty ?>
                  <?php if ($totalRows_Datoscarrito == 0) { // Show if recordset empty ?>
                    Tu carrito esta vacio.
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
mysql_free_result($Datoscarrito);
?>
