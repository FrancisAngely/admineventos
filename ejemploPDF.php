<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
 <style>
     *{margin: 0;padding: 0;}
     @page{size: 595pt 842pt;}
     table,tr,td{
         margin: 0pt;
         padding: 0pt;
     }
     .paginaA4{
          height: 842pt;
         width:595pt;
         margin: 0;
         padding: 0;
     }
     .cabecera{
         width:100%;
         background-color: aquamarine;
     }
     .cabecera td.contenedor{
         height: 100pt;
     }
     .pie{
         width:100%;
         background-color:blue;
     }
     .pie td.contenedor{
          height: 100pt;
     } 
     
     .contenido{
         width:100%;
     }
     .contenido td.contenedor{
         height:642pt;
     }
     
</style>
    </head>
<body>
<table class="paginaA4" cellspacing=0 cellpadding=0>
<tr class="cabecera"><td class="contenedor">&nbsp;</td></tr>    
<tr class="contenido"><td class="contenedor">&nbsp;</td></tr> 
<tr class="pie"><td class="contenedor">&nbsp;</td></tr> 
</table>

    
   <!-- <h1>Hola, mundo</h1>
    <img src="http://localhost/admineventos/eventos/evento_10.jpg">-->
</body>
</html>
<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Options;
use Dompdf\Dompdf;
$options = new Options();
$options->setIsRemoteEnabled(true);
$dompdf = new Dompdf($options);
//$dompdf=new DOMPDF();

$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf=$dompdf->output();
$filename="Ejemplo.pdf";
file_put_contents($filename,$pdf);
$dompdf->stream($filename,array('Attachment'=>0));
?>