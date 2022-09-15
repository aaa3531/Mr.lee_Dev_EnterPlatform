<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 대표아이디 설정
$wid = 'CMBL';

// 게시판 제목 폰트 설정
$font = 'font-16 en';

// 게시판 제목 하단라인컬러 설정 - red, blue, green, orangered, black, orange, yellow, navy, violet, deepblue, crimson..
$line = 'navy';

// 사이드 위치 설정 - left, right
$side = ($at_set['side']) ? 'left' : 'right';

?>
<style>
	.widget-index .at-main,
	.widget-index .at-side { padding-top:10px; padding-bottom:0px; }
	.widget-index .div-title-underbar { margin-bottom:15px; }
	.widget-index .div-title-underbar span { padding-bottom:4px; }
	.widget-index .div-title-underbar span b { font-weight:500; }
	.widget-index .widget-img img { display:block; max-width:100%; /* 배너 이미지 */ }
	.widget-box { margin-bottom:25px; }
</style>
<div class="at-container keyword-banner"><?php echo apms_widget('tto-oneline-msg', 'tto-oneline-msg'); // 한줄 메시지 ?></div>
<div class="at-container banner-index">
<div class="left-banner"><?php echo apms_widget('basic-banner-gallery', $wid.'-banner-main-left');?></div>
<div class="right-banner"><?php echo apms_widget('basic-banner-gallery', $wid.'-banner-main-right');?></div>
</div>
<div class="at-container widget-index">
    
	<div class="row at-row">
		<!-- 메인 영역 -->	
		<div class="col-md-9<?php echo ($side == "left") ? ' pull-right' : '';?> at-col at-main">
           <!-- 이미지 배너 시작 -->	
			<div class="widget-box widget-img">
				<?php echo apms_widget('basic-banner-gallery', $wid.'-banner-alliance');?>
			</div>
			<!-- 이미지 배너 끝 -->	
            <!-- 검증업체 시작 -->
			<div class="div-title-underbar">
				<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=mantang_cert">
					<span class="pull-right lightgray <?php echo $font;?>">+</span>
					<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
						<b>만땅넷 검증</b>
					</span>
				</a>
			</div>
			<div class="widget-box">
				<?php echo apms_widget('basic-post-webzine', $wid.'-wm101', 'bold=1 date=1'); ?>
			</div>
			<!-- 검증업체 끝 -->
			
			
			<!-- 웹툰 시작 -->
			<div class="div-title-underbar">
				<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=webtoon_bd">
					<span class="pull-right lightgray <?php echo $font;?>">+</span>
					<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
						<b>웹툰보기</b>
					</span>
				</a>
			</div>
			<div class="widget-box">
				<?php echo apms_widget('basic-post-slider-toons', $wid.'-wm8', 'center=1 nav=1', 'auto=0'); ?>
			</div>
			<!-- 웹툰 끝 -->	
			<!-- 다시보기 시작 -->
			<div class="div-title-underbar">
				<a href="<?php echo G5_BBS_URL;?>/main.php?gid=replay_li">
					<span class="pull-right lightgray <?php echo $font;?>">+</span>
					<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
						<b>다시보기</b>
					</span>
				</a>
			</div>
			<div class="widget-box">
				<?php echo apms_widget('basic-post-replay', $wid.'-wm9', 'center=1 nav=1', 'auto=0'); ?>
			</div>
			<!-- 다시보기 끝 -->	
			<div class="row main-pc">
				<div class="col-sm-6">

					<!-- 안구정화 시작-->
					<div class="div-title-underbar">
						<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=beauti_li">
							<span class="pull-right lightgray <?php echo $font;?>">+</span>
							<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
								<b>안구정화</b>
							</span>
						</a>
					</div>
					<div class="widget-box ankoo-main">
						<?php echo apms_widget('basic-post-gallery', $wid.'-wm1', 'icon={아이콘:caret-right} date=1 center=1 strong=1,2'); ?>
					</div>
					<!-- 안구정화 끝-->

				</div>
				<div class="col-sm-6">

					<!-- 뉴스 시작 -->
					<div class="div-title-underbar">
						<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=notice">
							<span class="pull-right lightgray <?php echo $font;?>">+</span>
							<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
								<b>공지사항</b>
							</span>
						</a>
					</div>
					<div class="widget-box">
						<?php echo apms_widget('basic-post-list', $wid.'-wm2', 'icon={아이콘:caret-right} date=1 center=1 strong=1,2'); ?>
					</div>
					<!-- 뉴스 끝 -->

				</div>
			</div>
			<div class="row main-mobile">
			    <div class="col-sm-6">

					<!-- 안구정화 시작-->
					<div class="div-title-underbar">
						<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=adult_place">
							<span class="pull-right lightgray <?php echo $font;?>">+</span>
							<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
								<b>성인업소</b>
							</span>
						</a>
					</div>
					<div class="widget-box">
				     <?php echo apms_widget('basic-post-gallery', $wid.'-wm68', 'bold=1 date=1'); ?>
			         </div>
					<!-- 안구정화 끝-->

				</div>
				<div class="col-sm-6">

					<!-- 뉴스 시작 -->
					<div class="div-title-underbar">
						<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=commu_loan">
							<span class="pull-right lightgray <?php echo $font;?>">+</span>
							<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
								<b>대출광고</b>
							</span>
						</a>
					</div>
					<div class="widget-box">
				<?php echo apms_widget('basic-post-list', $wid.'-wm7', 'bold=1 date=1'); ?>
			       </div>
					<!-- 뉴스 끝 -->

				</div>
			</div>
           <div class="row main-mobile">
			    <div class="col-sm-6">

					<!-- 안구정화 시작-->
					<div class="div-title-underbar">
						<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=adult_video">
							<span class="pull-right lightgray <?php echo $font;?>">+</span>
							<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
								<b>야동</b>
							</span>
						</a>
					</div>
					<div class="widget-box">
				     <?php echo apms_widget('basic-post-list', $wid.'-wm69', 'bold=1 date=1'); ?>
			         </div>
					<!-- 안구정화 끝-->

				</div>
				<div class="col-sm-6">

					<!-- 뉴스 시작 -->
					<div class="div-title-underbar">
						<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=beauti_li">
							<span class="pull-right lightgray <?php echo $font;?>">+</span>
							<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
								<b>안구정화</b>
							</span>
						</a>
					</div>
					<div class="widget-box ankoo-main">
				<?php echo apms_widget('basic-post-gallery', $wid.'-wm70', 'bold=1 date=1'); ?>
			       </div>
					<!-- 뉴스 끝 -->

				</div>
			</div>
            <!--	라이브 스코어		-->
           <div class="div-title-underbar main-mobile">
				<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=notice">
					<span class="pull-right lightgray <?php echo $font;?>">+</span>
					<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
						<b>공지사항</b>
					</span>
				</a>
			</div>
			<div class="widget-box main-mobile">
						<?php echo apms_widget('basic-post-list', $wid.'-wm2', 'icon={아이콘:caret-right} date=1 center=1 strong=1,2'); ?>
            </div>
			
		</div>
		
		<!-- -----------------------------------------------------------------------------사이드 영역 -->
		<div class="col-md-3<?php echo ($side == "left") ? ' pull-left' : '';?> at-col at-side">

			<?php if(!G5_IS_MOBILE) { //PC일 때만 출력 ?>
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
			<?php } ?>


            
			

			<!-- 랭킹 시작 -->
			<!-- 랭킹 끝 -->

			<!-- 설문 시작 -->
			<?php // 설문조사
				$is_poll_list = apms_widget('basic-poll', $wid.'-ws3', 'icon={아이콘:commenting}');
				if($is_poll_list) {
			?>
				<div class="div-title-underbar">
					<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
						<b>Poll</b>
					</span>
				</div>
				<div class="widget-box">
					<?php echo $is_poll_list; ?>
				</div>					
			<?php } ?>
			<!-- 설문 끝 -->

			 <!-- 성인업소 시작 -->
			<div class="div-title-underbar main-pc">
				<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=adult_place">
					<span class="pull-right lightgray <?php echo $font;?>">+</span>
					<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
						<b>성인업소</b>
					</span>
				</a>
			</div>
			<div class="widget-box main-pc">
				<?php echo apms_widget('basic-post-webzine', $wid.'-wm6', 'bold=1 date=1'); ?>
			</div>
			<!-- 성인업소 끝 -->
           <!-- 대출광고 시작 -->
			<div class="div-title-underbar main-pc">
				<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=commu_loan">
					<span class="pull-right lightgray <?php echo $font;?>">+</span>
					<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
						<b>대출광고</b>
					</span>
				</a>
			</div>
			<div class="widget-box main-pc">
				<?php echo apms_widget('basic-post-list', $wid.'-wm7', 'bold=1 date=1'); ?>
			</div>
			<!-- 대출광고 끝 -->
			<!-- SNS아이콘 시작 -->
			<div class="widget-box text-center">
				<?php echo $sns_share_icon; // SNS 공유아이콘 ?>
			</div>
			<!-- SNS아이콘 끝 -->

		</div>
	</div>
</div>
