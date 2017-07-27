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
$query_DatosUsuarios = "SELECT * FROM usuario ORDER BY usuario.Nbre_usuario ASC";
$DatosUsuarios = mysql_query($query_DatosUsuarios, $connectionBuyo) or die(mysql_error());
$row_DatosUsuarios = mysql_fetch_assoc($DatosUsuarios);
$totalRows_DatosUsuarios = mysql_num_rows($DatosUsuarios);
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
  <h1>User List</h1>
  <p>&nbsp;  
  <table border="0" align="center">
    <tr class="tablaprincipal">
      <td width="246">ID</td>
      <td width="265">Nombre</td>
      <td width="116">Acciones</td>
    </tr>
    <?php do { ?>
      <tr class="brillo">
        <td><a href="usuarios_datos.php?recordID=<?php echo $row_DatosUsuarios['ID_usuario']; ?>"> <?php echo $row_DatosUsuarios['ID_usuario']; ?>&nbsp; </a></td>
        <td><?php echo $row_DatosUsuarios['Nbre_usuario']; ?>&nbsp; </td>
        <td>Edit-Delete</td>
      </tr>
      <?php } while ($row_DatosUsuarios = mysql_fetch_assoc($DatosUsuarios)); ?>
  </table>
  <br />
  <?php echo $totalRows_DatosUsuarios ?> Registros Total
  </p>
  
  
  <!-- InstanceEndEditable -->
   
    
    <!-- end .content --></div>
  <div class="footer">
    <p>Administration Buy'O</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($DatosUsuarios);
?>
