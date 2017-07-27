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
$query_Recordset1 = "SELECT * FROM categoria ORDER BY categoria.Descripcion";
$Recordset1 = mysql_query($query_Recordset1, $connectionBuyo) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<div class="sidebarjett">
  <h3>Categoria</h3>
<ul>
<?php do { ?>
 <li><a href="categoria_ver.php?cat=<?php echo $row_Recordset1['ID_categoria']; ?>"><?php echo $row_Recordset1['Descripcion']; ?></a></li>
   <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>

   <?php
mysql_free_result($Recordset1);
?> 
 </ul>
</div>