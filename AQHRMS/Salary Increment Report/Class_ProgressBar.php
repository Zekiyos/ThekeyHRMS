<?php
/*
*   ProgrssBar Class
*
*/

class Progress_Bar
{
	public function progressbar($msgLoading,$microMin,$msgFinish){
if (ob_get_level() == 0) {
    ob_start();
}
echo str_pad($msgLoading.'... ',4096)."<br />\n";
$d=0;
for ($i = 0; $i < 25; $i++) {
    $d = $d + 11;
    $m=$d+10;
    //This div will show loading percents
    echo '<table align="center"><tr><td><div class="percents" >' . $i*4 . '%&nbsp;complete</div>';
    //This div will show progress bar
    echo '<div class="blocks"  style="left: '.$d.'px">&nbsp;</div></td></tr></table>';
    flush();
    ob_flush();
    usleep($microMin);
}
ob_end_flush();

echo '<div class="percents"  style="z-index:12">'.$msgFinish.'</div>';

	}
	
	
	
}