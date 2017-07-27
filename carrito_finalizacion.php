<?php require_once('Connections/connectionBuyo.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Documento sin título</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
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
                <h1><!-- InstanceBeginEditable name="titulo" -->Finalizacion de Pago<!-- InstanceEndEditable --></h1>
                <!-- InstanceBeginEditable name="EditRegion4" -->
                <?php if ($_POST["radio"] == 2)
				{
					
					ConfirmacionPago($_POST["radio"]); ?>
                <p>Has elegido pago de transferencia.</p>
                <p>Deberas remitirnos un Email con la certificacion de tu pago a: buyo@gmail.com realizado a este numero de cuenta:</p>
                <p>Bancomer: 12345678909</p>
                
                 <?php
				 $contenido = 'Hola xxxxxxx;<br><br><p>Deberas remitirnos un Email con la certificacion de tu pago a: buyo@gmail.com realizado a este numero de cuenta:</p><p>Bancomer: 12345678909</p>';
				 	 $asunto = 'Compra realizada en buyo.com';
                EnvioCorreoHTML(ObtenerMailUsario($_SESSION['MM_ID_usuario']),$contenido, $asunto)
                ?> 
                
                
               <?php }?> 
               
               

	 <?php if ($_POST["radio"] == 3)
	 // Pago por VISA/MASTERCARD/TRAJETA
				{
					
				ConfirmacionPago($_POST["radio"]); ?>
                <p>Has elegido pago por Trajeta/Debito.</p>
                <p>Haz click aqui para saltar a un servidor seguro donde podr&aacute;s realizar el pago</p>
                
                <form id="form2" name="form2" method="post" action="https://tpv2.4b.es/simulador/teargral.exe">
 <input name="order" type="hidden" id="order" value="<?php echo $_SESSION["compraactivavisa"];?>"/>
 <input name="store" type="hidden" id="store" value="XXXXXXXXXXX"/>
 <input type="submit" name="button3" id="button3" value="Confirmar Pago por Trajeta"/>
             
             </form>
                
                
               <?php }?>    
               
               
               
             
               	 <?php if ($_POST["radio"] == 1)
	 // Pago por Paypal
				{
					
				ConfirmacionPago($_POST["radio"]); ?>
                <p>Has elegido pago por Paypal.</p>
                <p>Haz click aqui para saltar alservidor seguro de Paypal</p>
                <FORM action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypal_form">
	<input type="hidden" name="upload" value="1" />
	<input type="hidden" name="amount" value="<?php echo $_SESSION["Totalcompra"]; ?>" />
	<input type="hidden" name="business" value="cuentabusiness@buyo.com" />
	<input type="hidden" name="receiver_email" value="cuentabusiness@buyo.com" />
	<input type="hidden" name="cmd" value="_xclick" />
	<input type="hidden" name="charset" value="utf-8" />
	<input type="hidden" name="currency_code" value="EUR" />
	<input type="hidden" name="item_name" value="Compra en la Web de buyo.com " />
	<input type="hidden" name="payer_id" value="<?php echo $_SESSION['MM_ID_usuario']; ?>" />
	<input type="hidden" name="payer_email" value="<?php echo ObtenerMailUsario($_SESSION['MM_ID_usuario']); ?>" />
	<input type="hidden" name="return" value="http://www.buyo.com/carrito_ok.php?control=<?php echo $_SESSION["compraactivavisa"]; ?>" />
	<input type="hidden" name="cancel_return" value="http://www.buyo.com/carrito_ko.php?control=<?php echo $_SESSION["compraactivavisa"]; ?>" 

/>
  	<input type="hidden" name="rm" value="2" />
	<input type="hidden" name="bn" value="PRESTASHOP_WPS" />
	<input type="hidden" name="cbt" value="Volver a www.buyo.com" />

        
        <input type="image" src="https://www.paypal.com/es_ES/ES/i/btn/btn_xpressCheckout.gif" name="image">
        </FORM>
      
                
               <?php }?>          
               
                <!-- InstanceEndEditable -->
      <!-- end .content --></div>
    <!-- end .subcontenedor --></div>
  <div class="footer">
    <p>Pied de pagina</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
