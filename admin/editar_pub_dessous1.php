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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE pub_dessous0 SET ID_producto=%s, link=%s, noticia=%s WHERE id_pub_dessous0=%s",
                       GetSQLValueString($_POST['ID_producto'], "int"),
                       GetSQLValueString($_POST['link'], "text"),
                       GetSQLValueString($_POST['noticia'], "text"),
                       GetSQLValueString($_POST['id_pub_dessous0'], "int"));

  mysql_select_db($database_connectionBuyo, $connectionBuyo);
  $Result1 = mysql_query($updateSQL, $connectionBuyo) or die(mysql_error());

  $updateGoTo = "pub_dessous.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$varpub_edit_pub = "0";
if (isset($_GET["recordID"])) {
  $varpub_edit_pub = $_GET["recordID"];
}
mysql_select_db($database_connectionBuyo, $connectionBuyo);
$query_edit_pub = sprintf("SELECT * FROM pub_dessous0 WHERE pub_dessous0.id_pub_dessous0=%s", GetSQLValueString($varpub_edit_pub, "int"));
$edit_pub = mysql_query($query_edit_pub, $connectionBuyo) or die(mysql_error());
$row_edit_pub = mysql_fetch_assoc($edit_pub);
$totalRows_edit_pub = mysql_num_rows($edit_pub);
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
  <h1>Editer</h1>
  <p>&nbsp;</p>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">N° Producto:</td>
        <th><input type="text" name="ID_producto" value="<?php echo htmlentities($row_edit_pub['ID_producto'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></th>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Link:</td>
        <th><input type="text" name="link" value="<?php echo htmlentities($row_edit_pub['link'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></th>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right" valign="top">Noticia:</td>
        <td><textarea name="noticia" cols="50" rows="5"><?php echo htmlentities($row_edit_pub['noticia'], ENT_COMPAT, 'iso-8859-1'); ?></textarea></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="submit" value="Actualizar registro" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="id_pub_dessous0" value="<?php echo $row_edit_pub['id_pub_dessous0']; ?>" />
  </form>
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
mysql_free_result($edit_pub);
?>
