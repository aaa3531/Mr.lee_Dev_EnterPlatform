<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

// 위젯 대표아이디 설정
$wid = 'CSB';

// 게시판 제목 폰트 설정
$font = 'font-16 en';

// 게시판 제목 하단라인컬러 설정 - red, blue, green, orangered, black, orange, yellow, navy, violet, deepblue, crimson..
$line = 'navy';

?>
<style>
	.widget-side .div-title-underbar { margin-bottom:15px; }
	.widget-side .div-title-underbar span { padding-bottom:4px; }
	.widget-side .div-title-underbar span b { font-weight:500; }
	.widget-box { margin-bottom:25px; }
</style>

<div class="widget-side">

	<div class="hidden-sm hidden-xs">
		<!-- 로그인 시작 -->
		<div class="div-title-underbar">
			<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
				<b><?php echo ($is_member) ? 'Profile' : 'Login';?></b>
			</span>
		</div>

		<div class="widget-box">
			<?php echo apms_widget('basic-outlogin'); //외부로그인 ?>
		</div>
		<!-- 로그인 끝 -->
	</div>	

	<?php 
	// 카테고리 체크
	$side_category = apms_widget('basic-category');
	if($side_category) { 
	?>
		<div class="div-title-underbar">
			<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
				<b>카테고리</b>
			</span>
		</div>

		<div class="widget-box">
			<?php echo $side_category;?>
		</div>
	<?php } ?>

	<!-- 채팅 시작 -->
	<div id="chat-div" class="widget-box uchat-widget">
	    <div id="chat-close"><i class="fas fa-times"></i></div>
		<?php

             if(!function_exists('uchat_array2data')) {
                 function uchat_array2data($arr) {
                     $arr['time'] = time();
                     ksort($arr);
                     $arr = array_filter($arr);
                     $arr['hash'] = md5(implode($arr['token'], $arr));
                     unset($arr['token']);
                     foreach ($arr as $k => &$v){ $v = $k.' '.urlencode($v); }
                     return implode("|", $arr);
                 }
                }

                $joinData = array();
                
                $joinData['room'] = 'mantang';
                $joinData['token'] = '9f48a0be6a0edffa34bdc98d36857d40';
                $joinData['nick'] = $member['nickname'];;
                $joinData['id'] = $member['mb_id'];;
                $joinData['level'] = $member['level'];
                if($member['level'] == 10)
                    $joinData['auth'] = 'subadmin';
                else
                    $joinData['auth'] = 'member';
                                       // (admin, subadmin, member, guest)중 하나선택, 미선택시 자동(권장)
                $joinData['icons'] = '';
                $joinData['nickcon'] = '';
                $joinData['other'] = '';
                
                ?>

        <script async src="//client.uchat.io/uchat.js"></script>
        <u-chat room='<?php echo $joinData["room"];?>' user_data='<?php echo uchat_array2data($joinData); ?>' style="display:inline-block; width:100%; height:100%;"></u-chat>;
	</div>
	<!-- 채팅 끝 -->

	<!-- 통계 시작 -->

	<!-- 통계 끝 -->

	<!-- SNS아이콘 시작 -->
	<div class="widget-box text-center">
		<?php echo $sns_share_icon; // SNS 공유아이콘 ?>
	</div>
	<!-- SNS아이콘 끝 -->

</div>