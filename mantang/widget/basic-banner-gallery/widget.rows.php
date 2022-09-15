<?php
if (!defined('_GNUBOARD_')) {

	// 모드
	$is_masonry = (isset($wset['masonry']) && $wset['masonry']) ? true : false;

	$wset['thumb_w'] = (isset($wset['thumb_w']) && $wset['thumb_w'] > 0) ? $wset['thumb_w'] : 300;
	if($is_masonry) {
		$wset['thumb_h'] = (isset($wset['thumb_h']) && $wset['thumb_h'] > 0) ? $wset['thumb_h'] : 0;
	} else {
		$wset['thumb_h'] = (isset($wset['thumb_h']) && $wset['thumb_h'] > 0) ? $wset['thumb_h'] : 250;
	}

}

//스타일
$is_thumb_no = (isset($wset['thumb_no']) && $wset['thumb_no']) ? true : false;

// 캡션
$caption = (isset($wset['caption']) && $wset['caption']) ? $wset['caption'] : '';
$is_caption = ($caption == "1") ? false : true;

// 배너 출력하기
if(!$wset['rows']) {
	$wset['rows'] = 4;
}

// 추출하기
$list = array();

// 슬라이더
$k=0;
for ($i=1; $i <= $wset['rows']; $i++) {

	if(!$wset['use'.$i]) continue; // 사용하지 않으면 건너뜀

	$wset['img'.$i] = ($wset['img'.$i])?$wset['img'.$i]:$widget_url.'/img/300x250.png';

	if($is_thumb_no){
		$list[$k]['img'] = $wset['img'.$i];
	}else{
		$img = apms_thumbnail($wset['img'.$i], $wset['thumb_w'], $wset['thumb_h'], false, true);
		$list[$k]['img'] = ($img['src']) ? $img['src'] : $wset['img'.$i];
	}

	$list[$k]['org'] = $wset['img'.$i];

	$list[$k]['subject'] = ($wset['subject'.$i]) ? $wset['subject'.$i] : '';

	$list[$k]['href'] = ($wset['link'.$i]) ? $wset['link'.$i] : 'javascript:;';
	$list[$k]['target'] = ($wset['target'.$i]) ? ' target="'.$wset['target'.$i].'"' : '';

	$k++;
}

$list_cnt = count($list);

// 랜덤
shuffle($list);

// 스타일
$is_center = (isset($wset['center']) && $wset['center']) ? ' text-center' : '';
$is_bold = (isset($wset['bold']) && $wset['bold']) ? true : false;

// 그림자
$shadow_in = '';
$shadow_out = (isset($wset['shadow']) && $wset['shadow']) ? apms_shadow($wset['shadow']) : '';
if($shadow_out && isset($wset['inshadow']) && $wset['inshadow']) {
	$shadow_in = '<div class="in-shadow">'.$shadow_out.'</div>';
	$shadow_out = '';
}

// 메이슨리 클래스
$img_wrap = ($is_masonry && !$wset['thumb_h']) ? 'post-img' : 'img-wrap';

// 리스트
for ($i=0; $i < $list_cnt; $i++) {

	//볼드체
	if($is_bold) {
		$list[$i]['subject'] = '<b>'.$list[$i]['subject'].'</b>';
	}

?>
	<div class="post-row">
		<div class="post-list post-col">
			<div class="post-image">
				<?php if($wset['lb']) { // Lightbox
					$caption = "<a href='".$list[$i]['href']."#bo_vc'>".apms_get_html($list[$i]['subject'], 1);
				?>
				<a href="<?php echo $list[$i]['org'];?>" data-lightbox="<?php echo $wid;?>-lightbox" data-title="<?php echo $caption;?>">
				<?php } else { ?>
				<a href="<?php echo ($list[$i]['href'])?$list[$i]['href']:'javascript:;';?>"<?php echo $target;?>>
				<?php } ?>
					<div class="<?php echo $img_wrap;?> is-round-post-img">
						<div class="img-item">
							<?php echo $shadow_in;?>
							<img src="<?php echo $list[$i]['img'];?>" alt="<?php echo $list[$i]['img'];?>" class="wr-img">
							<?php if($is_caption && $caption) { ?>
							<div class="in-subject ellipsis trans-bg-black<?php echo $is_center;?>">
								<?php echo $list[$i]['subject'];?>
							</div>
							<?php } ?>
						</div>
					</div>
				</a>
				<?php echo $shadow_out;?>
			</div>
			<?php if($is_caption && !$caption) { // 캡션이 아닐 때 ?>
				<?php if($wset['line_height']) { ?>
					<div class="post-content<?php echo $is_center;?>">
						<div class="post-subject">
							<a href="<?php echo $list[$i]['href'];?>"<?php echo $target;?>>
								<?php echo $list[$i]['subject'];?>
							</a>
						</div>
					</div>
				<?php } else { ?>

					<div class="post-content<?php echo $is_center;?>">
						<a href="<?php echo $list[$i]['href'];?>"<?php echo $target;?> class="ellipsis">
							<?php echo $list[$i]['subject'];?>
						</a>
					</div>

				<?php } ?>
			<?php } ?>
		</div>
	</div>
<?php } // end for ?>
<?php if(!$list_cnt) { ?>
	<div class="post-none">등록된 배너가 없습니다.</div>
<?php } ?>