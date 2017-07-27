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
$query_ms_slider = "SELECT * FROM slider";
$ms_slider = mysql_query($query_ms_slider, $connectionBuyo) or die(mysql_error());
$row_ms_slider = mysql_fetch_assoc($ms_slider);
$totalRows_ms_slider = mysql_num_rows($ms_slider);
?>
<script>
function asegurar()
{
	rc = confirm("¿Seguro que desea eliminar esta fila del Slider?");
	return rc;

}
</script>

<script>
function aseguraredit()
{
	rc = confirm("¿Seguro que desea editar esta fila del Slider?");
	return rc;

}
</script>

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
    <h1>Lista de Slider</h1>
    <p><a href="registro_slider.php">Registro de Slider</a></p>
    
      <table width="100%%" border="0" cellspacing="3" cellpadding="3">
        <tr>
          <td bgcolor="#FFFF00" scope="col">Titulo</td>
          <td bgcolor="#FFFF00" scope="col">Imagen</td>
          <td bgcolor="#FFFF00" scope="col">Orden</td>
          <td bgcolor="#FFFF00" scope="col">Estado</td>
          <td bgcolor="#FFFF00" scope="col">Accion</td>
        </tr>
        <?php do { ?>
        <tr>
          <td><?php echo $row_ms_slider['titulo']; ?></td>
          <td><img src="../data1/images/<?php echo $row_ms_slider['imagen']; ?>" width="50" height="25" /></td>
          <td><?php echo $row_ms_slider['orden']; ?></td>
          <td><?php if ($row_ms_slider['estado']==1)
		  echo "Activado";
		  else
		  echo "Desactivado"; ?></td>
          <td><a href="editar_slider.php?recordID=<?php echo $row_ms_slider['id_slider']; ?>"onclick="javascript:return aseguraredit();">Editar</a> - <a href="eliminar_slider.php?recordID=<?php echo $row_ms_slider['id_slider']; ?>"onclick="javascript:return asegurar();">Eliminar</a></td>
        </tr>
        <?php } while ($row_ms_slider = mysql_fetch_assoc($ms_slider)); ?>
      </table>
    
    <p>&nbsp;</p>
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
mysql_free_result($ms_slider);
?>
