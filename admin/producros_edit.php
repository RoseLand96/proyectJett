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
  $updateSQL = sprintf("UPDATE productos SET Nbre_producto=%s, SEO=%s, Precio=%s, Estado_producto=%s, Categoria=%s, strImagen=%s, intStock=%s WHERE ID_producto=%s",
                       GetSQLValueString($_POST['Nbre_producto'], "text"),
                       GetSQLValueString($_POST['SEO'], "text"),
                       GetSQLValueString($_POST['Precio'], "double"),
                       GetSQLValueString($_POST['Estado_producto'], "int"),
                       GetSQLValueString($_POST['Categoria'], "int"),
                       GetSQLValueString($_POST['strImagen'], "text"),
                       GetSQLValueString($_POST['intStock'], "int"),
                       GetSQLValueString($_POST['ID_producto'], "int"));

  mysql_select_db($database_connectionBuyo, $connectionBuyo);
  $Result1 = mysql_query($updateSQL, $connectionBuyo) or die(mysql_error());

  $updateGoTo = "productos_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$varProducto_DatosProducto = "0";
if (isset($_GET["recordID"])) {
  $varProducto_DatosProducto = $_GET["recordID"];
}
mysql_select_db($database_connectionBuyo, $connectionBuyo);
$query_DatosProducto = sprintf("SELECT * FROM productos WHERE productos.ID_producto=%s", GetSQLValueString($varProducto_DatosProducto, "int"));
$DatosProducto = mysql_query($query_DatosProducto, $connectionBuyo) or die(mysql_error());
$row_DatosProducto = mysql_fetch_assoc($DatosProducto);
$totalRows_DatosProducto = mysql_num_rows($DatosProducto);

mysql_select_db($database_connectionBuyo, $connectionBuyo);
$query_ConsultaCategorias = "SELECT * FROM categoria ORDER BY categoria.Descripcion ASC";
$ConsultaCategorias = mysql_query($query_ConsultaCategorias, $connectionBuyo) or die(mysql_error());
$row_ConsultaCategorias = mysql_fetch_assoc($ConsultaCategorias);
$totalRows_ConsultaCategorias = mysql_num_rows($ConsultaCategorias);
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
   <script>
  function subirimagen()
  {
	  self.name = 'opener';
			remote = open('gestionimagen.php', 'remote',
			'width=400,height=150,location=no,scrollbars=yes,menubars=no,toolbars=no,resizable=yes,fullscreen=no, status=yes');
			remote.focus();  
	  }
  
  </script>
  <h1>Editar Producto</h1>
  <p>&nbsp;</p>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Nombre:</td>
        <td><span id="sprytextfield1">
          <input type="text" name="Nbre_producto" value="<?php echo htmlentities($row_DatosProducto['Nbre_producto'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" />
          <span class="textfieldRequiredMsg">Necesario.</span></span></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">SEO:</td>
        <td><span id="sprytextfield2">
          <input type="text" name="SEO" value="<?php echo htmlentities($row_DatosProducto['SEO'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" />
          <span class="textfieldRequiredMsg">Necesario.</span></span></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Precio:</td>
        <td><span id="sprytextfield3">
          <input type="text" name="Precio" value="<?php echo htmlentities($row_DatosProducto['Precio'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" />
          <span class="textfieldRequiredMsg">Necesario.</span></span></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Estado:</td>
        <td><select name="Estado_producto">
          <option value="1" <?php if (!(strcmp(1, htmlentities($row_DatosProducto['Estado_producto'], ENT_COMPAT, 'iso-8859-1')))) {echo "SELECTED";} ?>>Activo</option>
          <option value="0" <?php if (!(strcmp(0, htmlentities($row_DatosProducto['Estado_producto'], ENT_COMPAT, 'iso-8859-1')))) {echo "SELECTED";} ?>>Inactivo</option>
        </select></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Stock:</td>
        <td><label for="intStock"></label>
          <input name="intStock" type="text" id="intStock" size="5"
          
           value="<?php echo htmlentities($row_DatosProducto['intStock'], ENT_COMPAT, 'iso-8859-1'); ?>"  
          
          
           /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Categoria:</td>
        <td><select name="Categoria">
          <?php 
do {  
?>
          <option value="<?php echo $row_ConsultaCategorias['ID_categoria']?>" <?php if (!(strcmp($row_ConsultaCategorias['ID_categoria'], htmlentities($row_DatosProducto['Categoria'], ENT_COMPAT, 'iso-8859-1')))) {echo "SELECTED";} ?>><?php echo $row_ConsultaCategorias['Descripcion']?></option>
          <?php
} while ($row_ConsultaCategorias = mysql_fetch_assoc($ConsultaCategorias));
?>
        </select></td>
      </tr>
      <tr> </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Imagen:</td>
        <td><input type="text" name="strImagen" value="<?php echo htmlentities($row_DatosProducto['strImagen'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" />
          <input type="button" name="button" id="button" value="Subir Imagen" onclick="javascript:subirimagen();"/></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="submit" value="Actualizar registro" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="ID_producto" value="<?php echo $row_DatosProducto['ID_producto']; ?>" />
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
<?php
mysql_free_result($DatosProducto);

mysql_free_result($ConsultaCategorias);
?>
