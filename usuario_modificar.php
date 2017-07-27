<?php require_once('Connections/connectionBuyo.php'); ?>
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
  $updateSQL = sprintf("UPDATE usuario SET Nbre_usuario=%s, Email=%s, Password=%s WHERE ID_usuario=%s",
                       GetSQLValueString($_POST['Nbre_usuario'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['ID_usuario'], "int"));

  mysql_select_db($database_connectionBuyo, $connectionBuyo);
  $Result1 = mysql_query($updateSQL, $connectionBuyo) or die(mysql_error());

  $updateGoTo = "usuario_modificacion_ok.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$varUsuario_DatosUsuario = "0";
if (isset($_SESSION["MM_ID_usuario"])) {
  $varUsuario_DatosUsuario = $_SESSION["MM_ID_usuario"];
}
mysql_select_db($database_connectionBuyo, $connectionBuyo);
$query_DatosUsuario = sprintf("SELECT * FROM usuario WHERE usuario.ID_usuario=%s", GetSQLValueString($varUsuario_DatosUsuario, "int"));
$DatosUsuario = mysql_query($query_DatosUsuario, $connectionBuyo) or die(mysql_error());
$row_DatosUsuario = mysql_fetch_assoc($DatosUsuario);
$totalRows_DatosUsuario = mysql_num_rows($DatosUsuario);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Modificar Datos Usuario</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
                <h1><!-- InstanceBeginEditable name="titulo" -->Modificar Datos de Usuario<!-- InstanceEndEditable --></h1>
                <!-- InstanceBeginEditable name="EditRegion4" -->
                <p>Modificar tus Datos.</p>
                <p>&nbsp;</p>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                  <table align="center">
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right">Nombre:</td>
                      <td><span id="sprytextfield1">
                        <input type="text" name="Nbre_usuario" value="<?php echo htmlentities($row_DatosUsuario['Nbre_usuario'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" />
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right">Email:</td>
                      <td><span id="sprytextfield2">
                        <input type="text" name="Email" value="<?php echo htmlentities($row_DatosUsuario['Email'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" />
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right">Password:</td>
                      <td><span id="sprytextfield3">
                        <input type="text" name="Password" value="<?php echo htmlentities($row_DatosUsuario['Password'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" />
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right">&nbsp;</td>
                      <td><input type="submit" value="Actualizar" /></td>
                    </tr>
                  </table>
                  <input type="hidden" name="MM_update" value="form1" />
                  <input type="hidden" name="ID_usuario" value="<?php echo $row_DatosUsuario['ID_usuario']; ?>" />
                </form>
                <p>&nbsp;</p>
                <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
                </script>
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
mysql_free_result($DatosUsuario);
?>
