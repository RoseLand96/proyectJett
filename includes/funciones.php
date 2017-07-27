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
//--------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------

function ObtenerNombreUsuario($identificador)
{
	global $database_connectionBuyo, $connectionBuyo;
	mysql_select_db($database_connectionBuyo, $connectionBuyo);
	$query_ConsultaFuncion = sprintf("SELECT usuario.Nbre_usuario FROM usuario WHERE usuario.ID_usuario=%s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $connectionBuyo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	 return $row_ConsultaFuncion['Nbre_usuario']; 
	mysql_free_result($ConsultaFuncion);
	}
	
	//--------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------

function ObtenerNombreProducto($identificador)
{
	global $database_connectionBuyo, $connectionBuyo;
	mysql_select_db($database_connectionBuyo, $connectionBuyo);
	$query_ConsultaFuncion = sprintf("SELECT Nbre_producto FROM productos WHERE ID_producto=%s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $connectionBuyo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	 return $row_ConsultaFuncion['Nbre_producto']; 
	mysql_free_result($ConsultaFuncion);
	}
		//--------------------------------------------------------------------------------------
		
		
		function ObtenerMailUsario($identificador)
{
	global $database_connectionBuyo, $connectionBuyo;
	mysql_select_db($database_connectionBuyo, $connectionBuyo);
	$query_ConsultaFuncion = sprintf("SELECT usuario.Email FROM usuario WHERE usuario.ID_usuario=%s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $connectionBuyo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	 return $row_ConsultaFuncion['Email']; 
	mysql_free_result($ConsultaFuncion);
	}
//--------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------

function ObtenerPrecioProducto($identificador)
{
	global $database_connectionBuyo, $connectionBuyo;
	mysql_select_db($database_connectionBuyo, $connectionBuyo);
	$query_ConsultaFuncion = sprintf("SELECT Precio FROM productos WHERE ID_producto=%s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $connectionBuyo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	 return $row_ConsultaFuncion['Precio']; 
	mysql_free_result($ConsultaFuncion);
	}
	//--------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------

function ObtenerIVA()
{
	global $database_connectionBuyo, $connectionBuyo;
	mysql_select_db($database_connectionBuyo, $connectionBuyo);
	$query_ConsultaFuncion ="SELECT intIVA FROM tblvariables WHERE idContador= 1";
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $connectionBuyo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	 return $row_ConsultaFuncion['intIVA']; 
	mysql_free_result($ConsultaFuncion);
	}
		//--------------------------------------------------------------------------------------

function ActualizacionCarrito($varcompra)
{
	
	global $database_connectionBuyo, $connectionBuyo;
	$updateSQL = sprintf("UPDATE carrito SET intTransaccionEfectuada = %s WHERE ID_usuario=%s AND intTransaccionEfectuada = 0",
                      $varcompra,$_SESSION['MM_ID_usuario']);
                  

  mysql_select_db($database_connectionBuyo, $connectionBuyo);
  $Result1 = mysql_query($updateSQL, $connectionBuyo) or die(mysql_error());	
}
//--------------------------------------------------------------------------------------

function ActualizacionEstadoCarrito($varcompra, $varestado)
{
	
	global $database_connectionBuyo, $connectionBuyo;
	$updateSQL = sprintf("UPDATE tblcompra SET intEstado = %s WHERE idCompra = %s",
                      $varestado,$varcompra);
                  

  mysql_select_db($database_connectionBuyo, $connectionBuyo);
  $Result1 = mysql_query($updateSQL, $connectionBuyo) or die(mysql_error());	
}

//--------------------------------------------------------------------------------------
function ConfirmacionPago($tipopago)
{
	global $database_connectionBuyo, $connectionBuyo;
	mysql_select_db($database_connectionBuyo, $connectionBuyo);
	
	
	
	
	 $insertSQL = sprintf("INSERT INTO tblcompra (ID_usuario, fchcompra, intTipoPago, dblTotal) VALUES (%s, NOW(), %s, %s)",
                       GetSQLValueString($_SESSION['MM_ID_usuario'], "int"),
					  $tipopago, $_SESSION["Totalcompra"]);
  $Result1 = mysql_query($insertSQL, $connectionBuyo) or die(mysql_error());
  $ultimacompra = mysql_insert_id();
  $_SESSION["compraactivavisa"]= $ultimacompra;
  ActualizacionCarrito($ultimacompra);
  
	
	
	
	}
//------------------------------------------------------------
function TextoFormaPago($vartipopago){
	if ($vartipopago == 1) return "Paypal";
	if ($vartipopago == 2) return "Transferencia";
	if ($vartipopago == 3) return "VISA/Mastercard";
	
	}
	//------------------------------------------------------------
function TextoEstadoCompra($varestado){
	if ($varestado == 0) return "Pendiente";
	if ($varestado == 1) return "Pagado y Enviado";
	if ($varestado == 2) return "Compra Cancelada";
	
	}	
//-----------------------------------------------------------
function EnvioCorreoHTML($destinatario, $contenido, $asunto)
{
	$mensaje = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td><img src="images/image1.png" width="177" height="106" longdesc="index.php" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><p>Estimado Cliente:</p>
      <p>';
	  
	  $mensaje.= $contenido;
	  
	  $mensaje.='</p>
  </tr>
  <tr>
    <td>Muchas gracias, puede contactarnos a través de nuestro correo electronico<br />
    <a href="mailto:buyo@yahoo.fr      ">buyo@yahoo.fr </a><br /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>

';
	
	
//Para enviar correo HTML, la cabecera Content-type debe definirse
$cabeceras = 'MINE-Version: 1.0' . "\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\n";

//Cabeceras adicionales
$cabeceras .= 'Form: buyo.com' . "\n";
$cabeceras .= 'Bcc: buyo.com' . "\n";

//enviarlo
mail($destinatario, $asunto, $mensaje, $cabeceras);



//---retirel le wap monte site la sou domaine nan..

//echo $mensaje;


	}
	
	
	//--------------------------------------------------------------------------------------

function Mostrar_Carrito_Usuario($identificador)
{
	global $database_connectionBuyo, $connectionBuyo;
	mysql_select_db($database_connectionBuyo, $connectionBuyo);
	$query_ConsultaFuncion = sprintf("SELECT * FROM carrito WHERE intTransaccionEfectuada=%s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $connectionBuyo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	  ?>
	<div class="subproductos">
	  <?php
	 
	 do {
		echo ObtenerNombreProducto ($row_ConsultaFuncion['idProducto']);
	 echo "<br>";
     
       } while ($row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion)); 
	 ?>
     </div>
      <?php
	mysql_free_result($ConsultaFuncion);
	}
	
	
?>

