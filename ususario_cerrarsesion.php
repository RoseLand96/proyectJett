
<?php 

    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
 error_reporting(0);
 ?>
 <?php
 session_start();
 session_destroy();
	  print"<script>window.location='index.php';</script>";      

?>
