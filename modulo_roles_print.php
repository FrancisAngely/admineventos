<?php
include("controller.php");
$rol=getById("roles",$_GET["id"]);

ob_start();
?>
        
 <table border=1>
<tr><td>Id:</td><td><?php echo $rol["id"];?></td></tr>
<tr><td>Role:</td><td><?php echo $rol["role"];?></td></tr>
</table> 


<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf=new DOMPDF();

$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf=$dompdf->output();
$filename="FichaRole".$_GET["id"].".pdf";
file_put_contents($filename,$pdf);
$dompdf->stream($filename,array('Attachment'=>0));
?>