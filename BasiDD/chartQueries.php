<?php
include("/lib/inc/chartphp_dist.php");
$p = new chartphp();
$p->data =array(array(1,2,3,4,5,6,7,8,9),array(9,8,7,6,5,4,3,2,1));
$p->chart_type = "area";
//render del grafico e ottenimento dell'output html/js
$out = $p->render('c1');
echo $out;
?>