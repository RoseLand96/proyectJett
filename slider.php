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
$query_ms_slider = "SELECT * FROM slider WHERE slider.estado=1 ORDER BY slider.orden";
$ms_slider = mysql_query($query_ms_slider, $connectionBuyo) or die(mysql_error());
$row_ms_slider = mysql_fetch_assoc($ms_slider);
$totalRows_ms_slider = mysql_num_rows($ms_slider);
?>
    <div id="wowslider-container1">
  <div class="ws_images">
            <ul>    
        <?php do { ?>
          <li><a href="<?php echo $row_ms_slider['link']; ?>">
          <img src="data1/images/<?php echo $row_ms_slider['imagen']; ?>"
           width="960" height="360" 
           alt="<?php echo $row_ms_slider['titulo']; ?>" 
           width="960" height="380" 
           title="<?php echo $row_ms_slider['titulo']; ?>"/></a><?php echo $row_ms_slider['noticia']; ?></li>
          <?php } while ($row_ms_slider = mysql_fetch_assoc($ms_slider)); ?>
      </ul>
    </div>
    </div>
  
    <?php
mysql_free_result($ms_slider);
?>
