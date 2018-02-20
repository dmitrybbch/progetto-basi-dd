<?php
    $s1 = $arrayx;
    $ticks = $arrayy;
    
    $pc = new C_PhpChartX(array($s1),'chart1');
    $pc->add_plugins(array('highlighter','pointLabels'));
	$pc->set_animate(true);
	$pc->set_series_default(array(
		'renderer'=>'plugin::BarRenderer',
		'pointLabels'=> array('show'=>true)));
    $pc->set_axes(array(
         'xaxis'=>array(
			'renderer'=>'plugin::CategoryAxisRenderer',
			'ticks'=>$ticks)
    ));
    $pc->set_highlighter(array('show'=>false));
    $pc->bind_js('jqplotDataClick',array(
		'series'=>'seriesIndex',
		'point'=>'pointIndex',
		'data'=>'data'));
    $pc->draw(400,300);
?>