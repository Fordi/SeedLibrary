<?php
function produceBoxes() {
	$bias = array(-506, -273);
	$vert = array(64, 110);
	$horiz = array(127, 0);
	$lines = array(16, 16, 16, 16, 16, 16, 16, 16, 16, 16); 
	$exclude = array(8, 23, 24, 35, 37, 38, 39, 40, 53, 54, 55, 56, 68, 69, 70, 71, 72, 85, 86, 87, 88, 100, 101, 102, 117);
	$excludeLeft = array(25, 57, 89, 103, 118, 132);
	$excludeRight = array(7, 22, 36, 52, 84, 116, 103, 118, 132);
	$excludeBottom = array(7, 19, 22, 36, 52, 84, 116, 25, 57);
	$out = array();
	for ($i=0; $i<array_sum($lines); $i++) {
		if (in_array($i, $exclude)) continue;
		$pos = array_merge($bias, array());
		$hp = $i;
		$vp = 0;
		while ($hp > $lines[$vp]-1) {
			$hp-=$lines[$vp];
			$vp++;
		}
		if (mt_rand(0,255)/255 < ($hp / $lines[$vp] + $vp / count($lines))*3/4) continue;
		if (($vp%2)!=0) $pos[0]-=$vert[0];
		$trans = mt_rand(0,1)==1 ? mt_rand(0,2) : -1;
		$hide = mt_rand(0,1)==1 ? mt_rand(0,2) : -1;
		//$hide = $trans = -1;
		$out[]='<div style="position: absolute; left: '.($pos[0]+$hp*$horiz[0]).'px; top: '.($pos[1]+$vert[1]*$vp).'px; ">';
		$out[]='<div class="mid-cube">';
		if ($hide != 0 && !in_array($i, $excludeBottom)) 
			$out[]='<div class="'.($trans==0?'semi ':'').'bottom-rhombus"></div>';
		if ($hide !=1 && !in_array($i, $excludeLeft))
			$out[]='<div class="'.($trans==1?'semi ':'').'left-rhombus"></div>';
		if ($hide !=2 && !in_array($i, $excludeRight))
			$out[]='<div class="'.($trans==2?'semi ':'').'right-rhombus"></div>';
		$out[]='</div></div>';
	}
	return join('',$out);
}