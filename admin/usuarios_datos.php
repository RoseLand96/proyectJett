<?php require_once('../Connections/connectionBuyo.php'); ?><?php
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

$colname_DetailRS1 = "-1";
if (isset($_GET['recordID'])) {
  $colname_DetailRS1 = $_GET['recordID'];
}
mysql_select_db($database_connectionBuyo, $connectionBuyo);
$query_DetailRS1 = sprintf("SELECT * FROM usuario WHERE ID_usuario = %s ORDER BY usuario.Nbre_usuario ASC", GetSQLValueString($colname_DetailRS1, "int"));
$DetailRS1 = mysql_query($query_DetailRS1, $connectionBuyo) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);
$totalRows_DetailRS1 = mysql_num_rows($DetailRS1);?>
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
  <h1>Information Usuario</h1>
  <table width="100%%" border="0" cellspacing="3" cellpadding="3">
    <tr>
      <td>N° Cliente: <?php echo $row_DetailRS1['ID_usuario']; ?></td>
    </tr>
  </table>
  <p>
  <table width="100%%" border="0" cellspacing="3" cellpadding="3">
    <tr>
      <td width="13%">Nombre:</td>
      <td width="87%"><?php echo $row_DetailRS1['Nbre_usuario']; ?></td>
    </tr>
    <tr>
      <td>Apellidos:</td>
      <td><?php echo $row_DetailRS1['ap_usuario']; ?></td>
    </tr>
    <tr>
      <td>E-Mail:</td>
      <td><?php echo $row_DetailRS1['Email']; ?></td>
    </tr>
    <tr>
      <td>Telefono:</td>
      <td><?php echo $row_DetailRS1['telefono']; ?></td>
    </tr>
  </table>
  </p>
  
  
  <!-- InstanceEndEditable -->
   
    
    <!-- end .content --></div>
  <div class="footer">
    <p>Administration Buy'O</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>