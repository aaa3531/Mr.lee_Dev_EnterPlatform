<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

//add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css">', 0);

$oneline_msg = array();

if(!$wset['oneline_msg'])
 $wset['oneline_msg'] = '한줄 메시지 위젯을 설정 하세요. (긴급 공지 및 명언 출력 활용)';

$oneline_msg = explode("\n", $wset['oneline_msg']);
$oneline_msg_cnt = count($oneline_msg);
?>

<?php
	if($oneline_msg_cnt) { 
		shuffle($oneline_msg);
?>
	<marquee height="50" behavior="scroll" class="tto-oneline-msg<?php echo ($wset['msg_color']) ? ' '.$wset['msg_color'] : '' ;?>">
			<?php echo $oneline_msg[0]; ?>
	</marquee>
<?php } ?>

<?php if($setup_href) { ?>
	<div class="btn-wset text-center p10">
		<a href="<?php echo $setup_href;?>" class="win_memo">
			<span class="text-muted"><i class="fa fa-cog"></i> 한줄 메시지 위젯설정</span>
		</a>
	</div>
<?php } ?>
