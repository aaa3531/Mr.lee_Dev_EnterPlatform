<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

?>
		<?php if($col_name) { ?>
			<?php if($col_name == "two") { ?>
					</div>
					<div class="col-md-<?php echo $col_side;?><?php echo ($at_set['side']) ? ' pull-left' : '';?> at-col at-side">
						<?php include_once($is_side_file); // Side ?>
					</div>
				</div>
			<?php } else { ?>
				</div><!-- .at-content -->
			<?php } ?>
			</div><!-- .at-container -->
		<?php } ?>
	</div><!-- .at-body -->

	<?php if(!$is_main_footer) { ?>
		<footer class="at-footer">
			<nav class="at-links">
				<div class="at-container">
					<ul class="pull-left">
					    
						<li><div id="sportiv-live-button" onclick="location.href='http://www.mantang01.net/sportslive/sportslive.php'">스포츠중계</div></li> 
						<li><div id="livescore-button">라이브스코어</div></li>				
						<li><div id="chat-button">채팅</div></li>				
					</ul>
<!--					라이브스코이 시작-->
					<div id="livescore-div" class="live-score-main">
						<div id="livescore-close"><i class="fas fa-times"></i></div>
				<h3>라이브 스코어</h3>
				<iframe id="live-score-section" src="https://www.mantang01.net/live/soccer-page.php" frameborder="0"></iframe>
			</div>
<!--                라이브스코어 끝   -->
                	<!-- PC 채팅 시작 -->
			<div id="chat-div" class="uchat-widget">
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
			<!-- PC 채팅 끝 -->
					<ul class="pull-right">
						<li><a href="<?php echo G5_BBS_URL;?>/page.php?hid=guide">이용안내</a></li>
						<li><a href="<?php echo $at_href['secret'];?>">문의하기</a></li>
						<li><a href="<?php echo $as_href['pc_mobile'];?>"><?php echo (G5_IS_MOBILE) ? 'PC' : '모바일';?>버전</a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
			</nav>
			<div class="at-infos">
				<div class="at-container">
					<?php if(IS_YC) { // YC5 ?>
						<div class="media">
							<div class="pull-right hidden-xs">
								<!-- 하단 우측 아이콘 -->
							</div>
							<div class="pull-left hidden-xs">
								<!-- 하단 좌측 로고 -->
								<i class="fa fa-leaf"></i>
							</div>
							<div class="media-body">
						
								<ul class="at-about hidden-xs">
									
								</ul>
								
								<div class="clearfix"></div>

								<div class="copyright">
									<strong><a href="mailto:<?php echo $default['de_admin_info_email']; ?>"><?php echo $config['cf_title'];?></a> <i class="fa fa-copyright"></i></strong>
									<span>All rights reserved.</span>
								</div>

								<div class="clearfix"></div>
							</div>
						</div>
					<?php } else { // G5 ?>
						<div class="at-copyright">
							<i class="fa fa-leaf"></i>
							<strong><?php echo $config['cf_title'];?> <i class="fa fa-copyright"></i></strong>
							All rights reserved.
						</div>
					<?php } ?>
				</div>
			</div>
		</footer>
	<?php } ?>
</div><!-- .wrapper -->

<div class="at-go">
	<div id="go-btn" class="go-btn">
		<span class="go-top cursor"><i class="fa fa-chevron-up"></i></span>
		<span class="go-bottom cursor"><i class="fa fa-chevron-down"></i></span>
	</div>
</div>

<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo THEMA_URL;?>/assets/js/respond.js"></script>
<![endif]-->

<!-- JavaScript -->
<script>
var sub_show = "<?php echo $at_set['subv'];?>";
var sub_hide = "<?php echo $at_set['subh'];?>";
var menu_startAt = "<?php echo ($m_sat) ? $m_sat : 0;?>";
var menu_sub = "<?php echo $m_sub;?>";
var menu_subAt = "<?php echo ($m_subsat) ? $m_subsat : 0;?>";
</script>
<script src="<?php echo THEMA_URL;?>/assets/bs3/js/bootstrap.min.js"></script>
<script src="<?php echo THEMA_URL;?>/assets/js/sly.min.js"></script>
<script src="<?php echo THEMA_URL;?>/assets/js/custom.js"></script>
<?php if($is_sticky_nav) { ?>
<script src="<?php echo THEMA_URL;?>/assets/js/sticky.js"></script>
<?php } ?>

<?php echo apms_widget('basic-sidebar'); //사이드바 및 모바일 메뉴(UI) ?>

<?php if($is_designer || $is_demo) include_once(THEMA_PATH.'/assets/switcher.php'); //Style Switcher ?>
