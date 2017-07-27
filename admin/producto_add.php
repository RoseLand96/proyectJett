<?php require_once('../Connections/connectionBuyo.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../venta_producto.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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
	
	
$imagen=$_FILES['strImagen']['name'];
move_uploaded_file($_FILES['strImagen']['tmp_name'],"../data1/strImagen/".$imagen);
	
  $insertSQL = sprintf("INSERT INTO productos (Nbre_producto, SEO, Precio, Estado_producto, Categoria, strImagen, ID_usuario, intStock,fecha_producto ) VALUES (%s,%s, %s, %s, %s, %s, %s, %s, NOW())",
                       GetSQLValueString($_POST['Nbre_producto'], "text"),
                       GetSQLValueString($_POST['SEO'], "text"),
                       GetSQLValueString($_POST['Precio'], "double"),
                       GetSQLValueString($_POST['Estado_producto'], "int"),
                       GetSQLValueString($_POST['Categoria'], "int"),
                       GetSQLValueString($imagen, "text"),
					   GetSQLValueString($_SESSION['MM_ID_usuario'], "int"),
                       GetSQLValueString($_POST['intStock'], "int"));
					
					 
						   

  mysql_select_db($database_connectionBuyo, $connectionBuyo);
  $Result1 = mysql_query($insertSQL, $connectionBuyo) or die(mysql_error());

  $insertGoTo = "../producto_agregado.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_connectionBuyo, $connectionBuyo);
$query_consultacategorias = "SELECT * FROM categoria ORDER BY categoria.Descripcion ASC";
$consultacategorias = mysql_query($query_consultacategorias, $connectionBuyo) or die(mysql_error());
$row_consultacategorias = mysql_fetch_assoc($consultacategorias);
$totalRows_consultacategorias = mysql_num_rows($consultacategorias);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Welcome to BUY'O</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
  <link href="preview/estilo.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
<link href="../estilo/principal_1.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="container">
  <div class="header">
    <div class="headerinterior"><a href="../index.php"><img src="../images/image1.png" width="110" height="50" alt="logo" /></a>
    <?php include("includes/catalogo2.php"); ?>
    </div>
    </div>
     
  <div class="subcontenedor">
              
    <div class="content">
                <h1><!-- InstanceBeginEditable name="titulo" --><!-- InstanceEndEditable --></h1>
                <!-- InstanceBeginEditable name="EditRegion4" -->

  <script>
  function subirimagen()
  {
    self.name = 'opener';
      remote = open('gestionimagen.php', 'remote',
      'width=400,height=150,location=no,scrollbars=yes,menubars=no,toolbars=no,resizable=yes,fullscreen=no, status=yes');
      remote.focus();  
    }
  
  </script>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" enctype="multipart/form-data">

    <p>&nbsp;</p>
    <h2>Add Product</h2>
    <p>&nbsp;</p>
    
    <table align="center">
      <tr valign="baseline">
        
        <td width="256"><span id="sprytextfield1">
         
         <h4> Nombre</h4>
          <input type="text" placeholder="nom de produit" name="Nbre_producto" value="" size="32" />
          <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
          <p>&nbsp;</p></td>
          
          
         
        <td><span id="sprytextfield2">
        <h4> SEO</h4>
<input type="text" placeholder="repeter nom du produit" name="SEO" value="" size="32" />
          <br />
          <br />
          <span class="textfieldRequiredMsg">Necesario.</span></span></td>
          
          
         
        <td><span id="sprytextfield3">
        <h4> Precio</h4>
            <input type="text"placeholder="prix en dollar"  name="Precio" value="" size="32" />
            <br />
            <br />
<br />
            <span class="textfieldRequiredMsg">Necesario.</span></span></td>
     
      </tr>
    
    
      <tr valign="baseline">
        
        <td><label for="intStock"></label>
          <span id="sprytextfield5">
          <h4> Cantidad</h4>
          <input name="intStock" placeholder="quantite de produit a vendre"  type="text" id="intStock" size="32" />
          <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
          <p>&nbsp;</p>
          </td>
    
      
      
         
        <td>
          <label for="Categoria"></label>
          <h4>&nbsp;</h4>
          
            <p>Categoria

              <select name="Categoria" id="Categoria" >
                <?php
do {  
?>
                <option value="<?php echo $row_consultacategorias['ID_categoria']?>"><?php echo $row_consultacategorias['Descripcion']?></option>
                <?php
} while ($row_consultacategorias = mysql_fetch_assoc($consultacategorias));
  $rows = mysql_num_rows($consultacategorias);
  if($rows > 0) {
      mysql_data_seek($consultacategorias, 0);
    $row_consultacategorias = mysql_fetch_assoc($consultacategorias);
  }
?>
              </select>
            </p>
            <p>&nbsp;</p>
          
          
          
          
        <td>
          <h4>&nbsp;</h4>
          <p>Estado
            <select name="Estado_producto">
              <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Activo</option>
              <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>Inactivo</option>
            </select>
          </p>
          <p>&nbsp;</p>
      
          </td>
        
            </tr>

      <tr valign="baseline">
       
        <td><label for="strImagen">
        <h4> Imagen 1</h4>
        </label>
        <p>
          <input type="file"  name="strImagen" id="file" />
        </p>
        <p>&nbsp; </p>
          </td>
          
          
           <td><label for="strImagen2">
        <h4> Imagen 2</h4>
        </label>
        <p>
          <input type="file"  name="strImagen2" id="file" />
        </p>
        <p>&nbsp; </p>
          </td>
          
           <td><label for="strImagen3">
        <h4> Imagen 3</h4>
        </label>
        <p>
          <input type="file"  name="strImagen3" id="file" />
        </p>
        <p>&nbsp; </p>
          </td>
          
          
          
          
          
      </tr>
      
      
      
     
     
   
      <tr valign="baseline">
        <td nowrap="nowrap" </td>
        <td><input type="submit" value="Insert Product" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form1" />
</form>



    <script src="preview/jquery.min.js"></script>
<script src="preview/script.js"></script>




  <p>&nbsp;</p>
  <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
  </script>
  
  
    	<form
         method="post"  enctype="multipart/form-data" id="uploadForm">
        </form>
  <!-- InstanceEndEditable -->
   













                <!-- InstanceEndEditable -->
      <!-- end .content --></div>
    <!-- end .subcontenedor --></div>
  <div class="footer">
    <p>Pied de pagina</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd -->


</html>
