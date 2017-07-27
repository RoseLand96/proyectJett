<?php require_once('Connections/connectionBuyo.php'); ?>
<?php 
$total = number_format($_SESSION["Totalcompra"], 2, ".", "");
$total = $total * 100;
//"M978" sinifica que el precio es en euros
echo "M978".$total."\r\n1\r\nBUYO\r\nProductos Buyo\r\n1\r\n".$total;
?>
