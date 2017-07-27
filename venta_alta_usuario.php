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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="alta_emailrepetido.php";
  $loginUsername = $_POST['Email'];
  $LoginRS__query = sprintf("SELECT Email FROM usuario WHERE Email=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_connectionBuyo, $connectionBuyo);
  $LoginRS=mysql_query($LoginRS__query, $connectionBuyo) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO usuario (Nbre_usuario, ap_usuario, telefono, Email, Activo, Password) VALUES (%s, %s, %s, %s, %s,%s)",
                       GetSQLValueString($_POST['Nbre_usuario'], "text"),
					   GetSQLValueString($_POST['ap_usuario'], "text"),
					   GetSQLValueString($_POST['telefono'], "int"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Activo'], "int"),
                       GetSQLValueString($_POST['Password'], "text"));

  mysql_select_db($database_connectionBuyo, $connectionBuyo);
  $Result1 = mysql_query($insertSQL, $connectionBuyo) or die(mysql_error());

  $insertGoTo = "venta_acceso.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Documento sin título</title>
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
                <h1><!-- InstanceBeginEditable name="titulo" --><!-- InstanceEndEditable --></h1>
                <!-- InstanceBeginEditable name="EditRegion4" -->
                
                <p>&nbsp;</p>
                <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                <h2>Formulario de alta en la tienda</h2>
                  <table align="center">
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right">Nombre:</td>
                      <td><span id="sprytextfield1">
                        <input type="text" name="Nbre_usuario" value="" size="32" />
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                               <tr valign="baseline">
                      <td nowrap="nowrap" align="right">Apellido:</td>
                      <td><span id="sprytextfield1">
                        <input type="text" name="ap_usuario" value="" size="32" />
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                               <tr valign="baseline">
                      <td nowrap="nowrap" align="right">Telefono:</td>
                      <td><span id="sprytextfield1">
                        <input type="text" name="telefono" value="" size="32" />
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                       </tr>
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right">Email:</td>
                      <td><span id="sprytextfield2">
                      <input type="text" name="Email" value="" size="32" />
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right">Password:</td>
                      <td><span id="sprytextfield3">
                        <input type="password" name="Password" value="" size="32" />
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right">&nbsp;</td>
                      <td><input type="submit" value="Darme de Alta" /></td>
                    </tr>
                  </table>
                  <input type="hidden" name="Activo" value="1" />
                  <input type="hidden" name="MM_insert" value="form1" />
                </form>
                <p>&nbsp;</p>
                <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email");
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
