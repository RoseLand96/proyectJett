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

$maxRows_connectionBuyo = 50;
$pageNum_connectionBuyo = 0;
if (isset($_GET['pageNum_connectionBuyo'])) {
  $pageNum_connectionBuyo = $_GET['pageNum_connectionBuyo'];
}
$startRow_connectionBuyo = $pageNum_connectionBuyo * $maxRows_connectionBuyo;

mysql_select_db($database_connectionBuyo, $connectionBuyo);
$query_connectionBuyo = "SELECT * FROM productos, usuario WHERE productos.ID_usuario=usuario.ID_usuario ORDER BY productos.ID_producto DESC";
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
<script>
function asegurar()
{
	rc = confirm("¿Seguro que desea eliminar este producto?");
	return rc;

}
</script>
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
  <h1>Product List</h1>
  <p><a href="producto_add.php">Add Product</a></p>
  <table width="100%" border="0">
    <tr class="tablaprincipal">
     <td bgcolor="#FFFF00">N° Produit</td>
     <td bgcolor="#FFFF00">N° Vendeur</td>
      <td bgcolor="#FFFF00">Product Name</td>
      <td bgcolor="#FFFF00">Estado</td>
      <td bgcolor="#FFFF00" >Stock</td>
      <td bgcolor="#FFFF00" >Fecha de Publicacion</td>
      <td bgcolor="#FFFF00" >Editar</td>
      <td bgcolor="#FFFF00" >Eliminar</td>
    </tr>
    <?php do { ?>
  <tr class="brillo">
  <td><?php echo $row_connectionBuyo['ID_producto']; ?></td>
          <td><a href="usuarios_datos.php?recordID=<?php echo $row_connectionBuyo['ID_usuario']; ?>"> <?php echo $row_connectionBuyo['ID_usuario']; ?>&nbsp; </a></td>
    <td><?php echo $row_connectionBuyo['Nbre_producto']; ?></td>
    <td><?php echo $row_connectionBuyo['Estado_producto']; ?></td>
    <td><?php echo $row_connectionBuyo['intStock']; ?></td>
    <td><?php echo $row_connectionBuyo['fecha_producto']; ?></td>
    <td><a href="producros_edit.php?recordID=<?php echo $row_connectionBuyo['ID_producto']; ?>">Edit</a></td>
    <td><a href="productos_delete.php?recordID=<?php echo $row_connectionBuyo['ID_producto']; ?> "onclick="javascript:return asegurar();">Delete</a></td>
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
