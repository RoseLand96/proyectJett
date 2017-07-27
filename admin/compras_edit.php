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

$varCompra_Datoscompra = "0";
if (isset($_GET["recordID"])) {
  $varCompra_Datoscompra = $_GET["recordID"];
}
mysql_select_db($database_connectionBuyo, $connectionBuyo);
$query_Datoscompra = sprintf("SELECT * FROM tblcompra, usuario WHERE tblcompra.ID_usuario=usuario.ID_usuario AND tblcompra.idCompra = %s", GetSQLValueString($varCompra_Datoscompra, "int"));
$Datoscompra = mysql_query($query_Datoscompra, $connectionBuyo) or die(mysql_error());
$row_Datoscompra = mysql_fetch_assoc($Datoscompra);
$totalRows_Datoscompra = mysql_num_rows($Datoscompra);

$varCarrito_ProductosCompra = "0";
if (isset($_GET["recordID"])) {
  $varCarrito_ProductosCompra = $_GET["recordID"];
}
$varUsuario_ProductosCompra = "0";
if (isset($row_Datoscompra['ID_usuario'])) {
  $varUsuario_ProductosCompra =$row_Datoscompra['ID_usuario'];
}
//------
mysql_select_db($database_connectionBuyo, $connectionBuyo);
$query_ProductosCompra = sprintf("SELECT productos.Nbre_producto,productos.ID_producto,
productos.Precio, carrito.intCantidad FROM carrito
Inner Join productos ON carrito.idProducto = productos.ID_producto WHERE
carrito.intTransaccionEfectuada = %s AND carrito.ID_usuario = %s", GetSQLValueString($varCarrito_ProductosCompra, "int"),GetSQLValueString($varUsuario_ProductosCompra, "int"));
$ProductosCompra = mysql_query($query_ProductosCompra, $connectionBuyo) or die(mysql_error());
$row_ProductosCompra = mysql_fetch_assoc($ProductosCompra);
$totalRows_ProductosCompra = mysql_num_rows($ProductosCompra);
?>
<script>
function asegurar()
{
	rc = confirm("¿Seguro que desea eliminar esta Compra?");
	return rc;

}
function asegurar1()
{
	rc1 = confirm("¿Verifica antes que el cliente ha pagado antes de confirmar la compra?");
	return rc1;

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
  <h1>Consultar Compra</h1>
  <table width="100%%" border="0" cellspacing="3" cellpadding="3">
    <tr>
      <td width="19%">N° Compra:</td>
      <td width="81%"><?php echo $row_Datoscompra['idCompra']; ?></td>
    </tr>
    <tr>
      <td>Nombre:</td>
      <td><?php echo $row_Datoscompra['Nbre_usuario']; ?></td>
    </tr>
    <tr>
      <td>Apellidos:</td>
      <td><?php echo $row_Datoscompra['ap_usuario']; ?></td>
    </tr>
    <tr>
      <td>Fecha:</td>
      <td><?php echo $row_Datoscompra['fchcompra']; ?></td>
    </tr>
    <tr>
      <td>Forma de pago:</td>
      <td><?php echo TextoFormaPago($row_Datoscompra['intTipoPago']); ?></td>
    </tr>
    <tr>
      <td>Total:</td>
      <td>$ <?php echo $row_Datoscompra['dblTotal']; ?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="105%" border="0" cellspacing="3" cellpadding="3">
    <tr>
      <td width="21%"><a href="compra_cancelar.php?recordID=<?php echo $row_Datoscompra['idCompra']; ?>&usuario=<?php echo $row_Datoscompra['ID_usuario']; ?>"onclick="javascript:return asegurar();">Cancelar Compra</a></td>
      <td width="79%"><a href="compra_aceptar.php?recordID=<?php echo $row_Datoscompra['idCompra']; ?>&usuario=<?php echo $row_Datoscompra['ID_usuario']; ?>"onclick="javascript:return asegurar1();">Compra Confirmada</a></td>
    </tr>
</table>
  <p><br />
    Producto:</p>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td bgcolor="#FFFF00">N° Producto</td>
      <td bgcolor="#FFFF00">Nombre Producto</td>
      <td bgcolor="#FFFF00">Precio sin Iva</td>
      <td bgcolor="#FFFF00">Cantidad</td>
      <td bgcolor="#FFFF00">Estado Actual Compra</td>
    </tr>
    <?php do { ?>
  <tr>
    
     <td><?php echo $row_ProductosCompra['ID_producto']; ?></td>
    <td><?php echo $row_ProductosCompra['Nbre_producto']; ?></td>
    <td>$ <?php echo $row_ProductosCompra['Precio']; ?></td>
    <td><?php echo $row_ProductosCompra['intCantidad']; ?></td>
    <td><?php echo TextoEstadoCompra($row_Datoscompra['intEstado']); ?></td>
  </tr>
  <?php } while ($row_ProductosCompra = mysql_fetch_assoc($ProductosCompra)); ?>
  </table>
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
mysql_free_result($Datoscompra);

mysql_free_result($ProductosCompra);
?>
