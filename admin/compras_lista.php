<?php require_once('../Connections/connectionBuyo.php'); ?>
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

$maxRows_connectionBuyo = 20;
$pageNum_connectionBuyo = 0;
if (isset($_GET['pageNum_connectionBuyo'])) {
  $pageNum_connectionBuyo = $_GET['pageNum_connectionBuyo'];
}
$startRow_connectionBuyo = $pageNum_connectionBuyo * $maxRows_connectionBuyo;

mysql_select_db($database_connectionBuyo, $connectionBuyo);
$query_connectionBuyo = "SELECT * FROM tblcompra,usuario where tblcompra.ID_usuario=usuario.ID_usuario ORDER BY fchcompra DESC";
$query_limit_connectionBuyo = sprintf("%s LIMIT %d, %d", $query_connectionBuyo, $startRow_connectionBuyo, $maxRows_connectionBuyo);
$connectionBuyo = mysql_query($query_limit_connectionBuyo, $connectionBuyo) or die(mysql_error());
$row_connectionBuyo = mysql_fetch_assoc($connectionBuyo);

if (isset($_GET['totalRows_connectionBuyo'])) {
  $totalRows_connectionBuyo = $_GET['totalRows_connectionBuyo'];
} else {
  $all_connectionBuyo = mysql_query($query_connectionBuyo);
  $totalRows_connectionBuyo = mysql_num_rows($all_connectionBuyo);
}
$totalPages_connectionBuyo = ceil($totalRows_connectionBuyo/$maxRows_connectionBuyo)-1;
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
    <h1>Lista de Compras  </h1>
    <table width="100%" border="0">
      <tr class="tablaprincipal">
       <td>N° Compra</td>
      <td>Nombre Persona</td>
      <td>fecha </td>
      <td>Forma de pago</td>
      <td >Accion</td>
    </tr>
    
    <?php do { ?>
  
    
  <tr class="brillo">
   <td><?php echo $row_connectionBuyo['idCompra']; ?></td>
    <td><?php echo $row_connectionBuyo['Nbre_usuario']; ?></td>
     <td><?php echo $row_connectionBuyo['fchcompra']; ?></td>
    <td><?php echo TextoFormaPago ($row_connectionBuyo['intTipoPago']); ?></td>
    <td><a href="compras_edit.php?recordID=<?php echo $row_connectionBuyo['idCompra']; ?>">Ver</a></td>
  </tr>
  <?php } while ($row_connectionBuyo = mysql_fetch_assoc($connectionBuyo)); ?>
  </table>
  
  
  
  <!-- InstanceEndEditable -->
   
    
    <!-- end .content --></div>
  <div class="footer">
    <p>Administration Buy'O</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($connectionBuyo);
?>
