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

mysql_select_db($database_connectionBuyo, $connectionBuyo);
$query_select_pub1 = "SELECT * FROM pub_dessous0, productos WHERE pub_dessous0.ID_producto=productos.ID_producto";
$select_pub1 = mysql_query($query_select_pub1, $connectionBuyo) or die(mysql_error());
$row_select_pub1 = mysql_fetch_assoc($select_pub1);
$totalRows_select_pub1 = mysql_num_rows($select_pub1);
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
  <h1>Pub dessous</h1>
  <p><a href="insert_pub1.php">Ajouter un Pub</a></p>
  <table width="100%%" border="0" cellspacing="3" cellpadding="3">
    <tr>
      <td bgcolor="#FFFF00">Producto</td>
      <td bgcolor="#FFFF00">Noticia</td>
      <td bgcolor="#FFFF00">Accion</td>
    </tr>
    <?php do { ?>
  <tr>
    <td><img src="../documentos/productos/<?php echo $row_select_pub1['strImagen']; ?>" width="100" height="70" /></td>
    <td><?php echo $row_select_pub1['noticia']; ?></td>
    <td><a href="editar_pub_dessous1.php?recordID=<?php echo $row_select_pub1['id_pub_dessous0']; ?>">Editer</a></td>
  </tr>
  <?php } while ($row_select_pub1 = mysql_fetch_assoc($select_pub1)); ?>
    </table>
  <p>&nbsp;</p>
  
  
  <!-- InstanceEndEditable -->
   
    
    <!-- end .content --></div>
  <div class="footer">
    <p>Administration Buy'O</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($select_pub1);
?>
