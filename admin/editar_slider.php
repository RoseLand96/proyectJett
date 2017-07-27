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
	
	$imagen=$_FILES['imagen']['name'];
move_uploaded_file($_FILES['imagen']['tmp_name'],"../data1/images/".$imagen);
	
  $updateSQL = sprintf("UPDATE slider SET titulo=%s, imagen=%s, noticia=%s, link=%s, orden=%s, estado=%s WHERE id_slider=%s",
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($imagen, "text"),
                       GetSQLValueString($_POST['noticia'], "text"),
                       GetSQLValueString($_POST['link'], "text"),
                       GetSQLValueString($_POST['orden'], "int"),
                       GetSQLValueString($_POST['estado'], "int"),
                       GetSQLValueString($_POST['id_slider'], "int"));

  mysql_select_db($database_connectionBuyo, $connectionBuyo);
  $Result1 = mysql_query($updateSQL, $connectionBuyo) or die(mysql_error());

  $updateGoTo = "lista_slider.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$varSlider_edit_slider = "0";
if (isset($_GET["recordID"])) {
  $varSlider_edit_slider = $_GET["recordID"];
}
mysql_select_db($database_connectionBuyo, $connectionBuyo);
$query_edit_slider = sprintf("SELECT * FROM slider WHERE slider.id_slider = %s", GetSQLValueString($varSlider_edit_slider, "int"));
$edit_slider = mysql_query($query_edit_slider, $connectionBuyo) or die(mysql_error());
$row_edit_slider = mysql_fetch_assoc($edit_slider);
$totalRows_edit_slider = mysql_num_rows($edit_slider);
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
  <h1>&nbsp;</h1>
  <p>&nbsp;</p>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" enctype="multipart/form-data">
    <h2>Editar Slider</h2>
    <table align="center">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Titulo:</td>
        <th><input type="text" name="titulo" value="<?php echo htmlentities($row_edit_slider['titulo'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></th>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Imagen:</td>
        <th><input type="file" name="imagen" value="<?php echo htmlentities($row_edit_slider['imagen'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></th>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right" valign="top">Noticia:</td>
        <th><textarea name="noticia" cols="50" rows="5"><?php echo htmlentities($row_edit_slider['noticia'], ENT_COMPAT, 'iso-8859-1'); ?></textarea></th>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Link:</td>
        <th><input type="text" name="link" value="<?php echo htmlentities($row_edit_slider['link'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></th>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Orden:</td>
        <th><input type="text" name="orden" value="<?php echo htmlentities($row_edit_slider['orden'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></th>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Estado:</td>
        <th><select name="estado">
          <option value="1" <?php if (!(strcmp(1, htmlentities($row_edit_slider['estado'], ENT_COMPAT, 'iso-8859-1')))) {echo "SELECTED";} ?>>Activo</option>
          <option value="0" <?php if (!(strcmp(0, htmlentities($row_edit_slider['estado'], ENT_COMPAT, 'iso-8859-1')))) {echo "SELECTED";} ?>>Desactivo</option>
        </select></th>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <th><input type="submit" value="Actualizar registro" /></th>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="id_slider" value="<?php echo $row_edit_slider['id_slider']; ?>" />
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
mysql_free_result($edit_slider);
?>
