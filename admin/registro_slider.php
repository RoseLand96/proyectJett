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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
$imagen=$_FILES['imagen']['name'];
move_uploaded_file($_FILES['imagen']['tmp_name'],"../data1/images/".$imagen);
$insertSQL = sprintf("INSERT INTO slider (titulo, imagen, noticia, link, orden, estado) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($imagen, "text"),
                       GetSQLValueString($_POST['noticia'], "text"),
                       GetSQLValueString($_POST['link'], "text"),
                       GetSQLValueString($_POST['orden'], "int"),
                       GetSQLValueString($_POST['estado'], "int")); 

  mysql_select_db($database_connectionBuyo, $connectionBuyo);
  $Result1 = mysql_query($insertSQL, $connectionBuyo) or die(mysql_error());

  $insertGoTo = "lista_slider.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Baseadmin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-l" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Administration Buy'O</title>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
<link href="../estilo/estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
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
    <h2>Agregar Slider</h2>
    <table align="center">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Titulo:</td>
        <th><span id="sprytextfield1">
          <input type="text" name="titulo" value="" size="32" />
          <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>     </th>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Imagen:</td>
        <th><span id="sprytextfield2">
          <label for="text1"></label>
          <input type="file" name="imagen" value="" size="32" />
          <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>          </th>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right" valign="top">Noticia:</td>
        <th><span id="sprytextfield3">
          <label for="text2"></label>
           <textarea name="noticia" cols="50" rows="5"></textarea>
          <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>         </th>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Link:</td>
        <th><input type="text" name="link" value="" size="32" /></th>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Orden:</td>
        <th><input type="text" name="orden" value="" size="32" /></th>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Estado:</td>
        <th><select name="estado">
          <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Activo</option>
          <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>Desactivado</option>
        </select></th>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <th><input type="submit" value="Insertar registro" /></th>
      </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form1" />
  </form>
  <p>&nbsp;</p>
  <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
  </script>
  <!-- InstanceEndEditable -->
   
    
    <!-- end .content --></div>
  <div class="footer">
    <p>Administration Buy'O</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>