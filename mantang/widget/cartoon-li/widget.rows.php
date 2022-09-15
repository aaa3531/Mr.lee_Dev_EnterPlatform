<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 추출하기
$list = apms_board_rows($wset);
$list_cnt = count($list);

// 아이콘
$icon = (isset($wset['icon']) && $wset['icon']) ? apms_fa($wset['icon']) : '';

// 랭킹
$rank = apms_rank_offset($wset['rows'], $wset['page']); 

// 링크
$is_link = (isset($wset['link']) && $wset['link']) ? true : false;

// 날짜
$wset['date'] = (isset($wset['date']) && $wset['date']) ? $wset['date'] : '';

// 리스트
for ($i=0; $i < $list_cnt; $i++) { 
	// 링크#1
	$target = '';
	if($is_link && $list[$i]['wr_link1']) {
		$list[$i]['href'] = $list[$i]['link_href'][1];
		$target = ' target="_blank"';
	}
?>
<?php if(!$list[$i]['wr_1']) { ?>
	<li>
		<a href="<?php echo $list[$i]['href'];?>">
			
				<div class="webtoons_list_thumb">
					<div class="webtoons_thumb_img">
						<img src="<?php echo $list[$i]['as_thumb'];?>">
					</div>
				</div>
				<div class="webtoons_list_subject">
					<div class="stickers_wrap">
						<div>
							
						</div>
						<?php if ($list[$i]['new']) { ?>
							<div class="webtoons_up">
							</div>
						<?php } ?>
					</div>
					<?php echo $list[$i]['wr_subject']; ?>
				</div>
		</a>
	</li>
<?php } ?>
<?php } ?>


<?php if(!$list_cnt) { ?>
<?php } ?>