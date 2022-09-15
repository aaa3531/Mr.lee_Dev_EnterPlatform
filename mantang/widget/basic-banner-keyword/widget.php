<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

global $at_href;

//add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css">', 0);
$q = explode(",", $wset['q']);
$q_cnt = count($q);
if($q_cnt) shuffle($q);

?>
<div class="split-banner">
    <?php echo $q[$i];?>
</div>
<?php if($setup_href) { ?>
	<div class="btn-wset text-center p10">
		<a href="<?php echo $setup_href;?>" class="win_memo">
			<span class="text-muted"><i class="fa fa-cog"></i> 위젯설정</span>
		</a>
	</div>
<?php } ?>