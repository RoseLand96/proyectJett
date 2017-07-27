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

mysql_select_db($database_connectionBuyo, $connectionBuyo);
$query_ms_pub1 = "SELECT * FROM pub_dessous1";
$ms_pub1 = mysql_query($query_ms_pub1, $connectionBuyo) or die(mysql_error());
$row_ms_pub1 = mysql_fetch_assoc($ms_pub1);
$totalRows_ms_pub1 = mysql_num_rows($ms_pub1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Welcome to BUY'O</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="estilo/principal.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
  <script type="text/javascript" src="engine1/jquery.js"></script>
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
              
              
              <!-- end .sidebar1 --></div>
    <div class="content">
      <h1><!-- InstanceBeginEditable name="titulo" --> 
                
                
                  <div class="slider"><?php include("slider.php")?></div>
                <!-- InstanceEndEditable --></h1>
                <!-- InstanceBeginEditable name="EditRegion4" -->
               <p>&nbsp;</p>
               <p>&nbsp;</p>
                <table width="100%%" border="0" cellspacing="3" cellpadding="3">
                  <tr>
                    <th scope="col"><img src="data1/pub1/<?php echo $row_ms_pub1['imagen']; ?>" width="250" height="200" /></th>
                    <th scope="col"><img src="data1/pub1/<?php echo $row_ms_pub1['imagen1']; ?>" width="250" height="200" /></th>
                    <th scope="col"><img src="data1/pub1/<?php echo $row_ms_pub1['imagen2']; ?>" width="250" height="200" /></th>
                    <th scope="col"><img src="data1/pub1/<?php echo $row_ms_pub1['imagen3']; ?>" width="250" height="200" /></th>
                 <th scope="col"><img src="data1/pub1/<?php echo $row_ms_pub1['imagen4']; ?>" width="250" height="200" /></th>
                  </tr>
                  <tr>
                    
                   
                    <td><img src="data1/pub1/<?php echo $row_ms_pub1['imagen5']; ?>" width="250" height="200" /></td>
                  </tr>
                </table>
                <!-- InstanceEndEditable -->
      <!-- end .content --></div>
    <!-- end .subcontenedor --></div>
  <div class="footer">
    <p>Pied de pagina</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
  <script type="text/javascript" src="engine1/wowslider.js"></script>
  <script type="text/javascript" src="engine1/script.js"></script>
  
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($ms_pub1);
?>
