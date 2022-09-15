<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
include_once(THEMA_PATH.'/assets/thema.php');
?>
<?  
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
?>
<script src="https://kit.fontawesome.com/09f10efa95.js" crossorigin="anonymous"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-153292588-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-153292588-1');
</script>
<div id="thema_wrapper" class="wrapper <?php echo $is_thema_layout;?> <?php echo $is_thema_font;?>">

	<!-- LNB -->
	<aside class="at-lnb">
		<div class="at-container">
			<!-- LNB Left -->
			<div class="pull-left">
				<ul>
					<li><a href="javascript:;" id="favorite">즐겨찾기</a></li>
					<li><a href="<?php echo $at_href['rss'];?>" target="_blank">RSS 구독</a></li>
					<?php
					  $tweek = array("일", "월", "화", "수", "목", "금", "토");
					?>	
					<li><a><?php echo date('m월 d일');?>(<?php echo $tweek[date("w")];?>)</a></li>
				</ul>
			</div>
			<!-- LNB Right -->
			<div class="pull-right">
				<ul>
					<?php if($is_member) { // 로그인 상태 ?>
						<li><a href="javascript:;" onclick="sidebar_open('sidebar-user');"><b><?php echo $member['mb_nick'];?></b></a></li>
						<?php if($member['admin']) {?>
							<li><a href="<?php echo G5_ADMIN_URL;?>">관리</a></li>
						<?php } ?>
						<?php if($member['partner']) { ?>
							<li><a href="<?php echo $at_href['myshop'];?>">마이샵</a></li>
						<?php } ?>
						<li class="sidebarLabel"<?php echo ($member['response'] || $member['memo']) ? '' : ' style="display:none;"';?>>
							<a href="javascript:;" onclick="sidebar_open('sidebar-response');"> 
								알림 <b class="orangered sidebarCount"><?php echo $member['response'] + $member['memo'];?></b>
							</a>
						</li>
					<?php } else { // 로그아웃 상태 ?>
						<li><a href="<?php echo $at_href['login'];?>" onclick="sidebar_open('sidebar-user'); return false;">로그인</a></li>
						<li><a href="<?php echo $at_href['reg'];?>">회원가입</a></li>
						<li><a href="<?php echo $at_href['lost'];?>" class="win_password_lost">정보찾기	</a></li>
					<?php } ?>
					<?php if(IS_YC) { // 영카트 사용하면 ?>
					<?php } ?>
					<?php if($member['admin']) { ?>
					<li><a href="<?php echo $at_href['connect'];?>">접속 <?php echo number_format($stats['now_total']); ?><?php echo ($stats['now_mb']) ? ' (<b class="orangered">'.number_format($stats['now_mb']).'</b>)' : ''; ?></a></li>
					<?php } ?>
					<?php if($is_member) { ?>
						<li><a href="<?php echo $at_href['logout'];?>">로그아웃	</a></li>
					<?php } ?>
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
	</aside>

	<!-- PC Header -->
	<header class="pc-header">
		<div class="at-container">
			<!-- PC Logo -->
			<div class="header-logo">
				<a href="<?php echo $at_href['home'];?>">
					<img src="<?php echo THEMA_URL;?>/assets/img/logo.svg">
				</a>
			</div>
			<!-- PC Search -->
			<div class="clearfix"></div>
		</div>
	</header>

	<!-- Mobile Header -->
	<header class="m-header">
		<div class="at-container">
			<div class="header-wrap">
				<div class="header-icon">
					<a href="javascript:;" onclick="sidebar_open('sidebar-user');">
						<i class="fa fa-user"></i>
					</a>
				</div>
				<div class="header-logo en">
					<!-- Mobile Logo -->
					<a href="<?php echo $at_href['home'];?>">
						<img src="<?php echo THEMA_URL;?>/assets/img/logo.svg">
					</a>
				</div>
				<div class="header-icon">
					<a href="javascript:;" onclick="sidebar_open('sidebar-search');">
						<i class="fa fa-search"></i>
					</a>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</header>

	<!-- Menu -->
	<nav class="at-menu">
		<!-- PC Menu -->
		<div class="pc-menu">
			<!-- Menu Button & Right Icon Menu -->
			<div class="at-container">
				<div class="nav-right nav-rw nav-height">
					<ul>
						<?php if(IS_YC) { //영카트 ?>
							
						<?php } ?>
						<li>
							<a href="javascript:;" onclick="sidebar_open('sidebar-response');"<?php echo tooltip('알림');?>>
								<i class="fa fa-bell"></i>
								<span class="label bg-orangered en"<?php echo ($member['response'] || $member['memo']) ? '' : ' style="display:none;"';?>>
									<span class="msgCount"><?php echo number_format($member['response'] + $member['memo']);?></span>
								</span>
							</a>
						</li>
						<li>
							<a href="javascript:;" onclick="sidebar_open('sidebar-search');"<?php echo tooltip('검색');?>>
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="menu-all-icon"<?php echo tooltip('전체메뉴');?>>
							<a href="javascript:;" data-toggle="collapse" data-target="#menu-all">
								<i class="fa fa-th"></i>
							</a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
			<?php include_once(THEMA_PATH.'/menu.php');	// 메뉴 불러오기 ?>
			<div class="clearfix"></div>
			<div class="nav-back"></div>
		</div><!-- .pc-menu -->

		<!-- PC All Menu -->
		<div class="pc-menu-all">
			<div id="menu-all" class="collapse">
				<div class="at-container table-responsive">
					<table class="table">
					<tr>
					<?php 
						$az = 0;
						for ($i=1; $i < $menu_cnt; $i++) {

							if(!$menu[$i]['gr_id']) continue;

							// 줄나눔
							if($az && $az%$is_allm == 0) {
								echo '</tr><tr>'.PHP_EOL;
							}
					?>
						<td class="<?php echo $menu[$i]['on'];?>">
							<a class="menu-a" href="<?php echo $menu[$i]['href'];?>"<?php echo $menu[$i]['target'];?>>
								<?php echo $menu[$i]['name'];?>
								<?php if($menu[$i]['new'] == "new") { ?>
									<i class="fa fa-bolt new"></i>
								<?php } ?>
							</a>
							<?php if($menu[$i]['is_sub']) { //Is Sub Menu ?>
								<div class="sub-1div">
									<ul class="sub-1dul">
									<?php for($j=0; $j < count($menu[$i]['sub']); $j++) { ?>

										<?php if($menu[$i]['sub'][$j]['line']) { //구분라인 ?>
											<li class="sub-1line"><a><?php echo $menu[$i]['sub'][$j]['line'];?></a></li>
										<?php } ?>

										<li class="sub-1dli <?php echo $menu[$i]['sub'][$j]['on'];?>">
											<a href="<?php echo $menu[$i]['sub'][$j]['href'];?>" class="sub-1da<?php echo ($menu[$i]['sub'][$j]['is_sub']) ? ' sub-icon' : '';?>"<?php echo $menu[$i]['sub'][$j]['target'];?>>
												<?php echo $menu[$i]['sub'][$j]['name'];?>
												<?php if($menu[$i]['sub'][$j]['new'] == "new") { ?>
													<i class="fa fa-bolt sub-1new"></i>
												<?php } ?>
											</a>
										</li>
									<?php } //for ?>
									</ul>
								</div>
							<?php } ?>
						</td>
					<?php $az++; } //for ?>
					</tr>
					</table>
					<div class="menu-all-btn">
						<div class="btn-group">
							<a class="btn btn-lightgray" href="<?php echo $at_href['main'];?>"><i class="fa fa-home"></i></a>
							<a href="javascript:;" class="btn btn-lightgray" data-toggle="collapse" data-target="#menu-all"><i class="fa fa-times"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .pc-menu-all -->

		<!-- Mobile Menu -->
		<div class="m-menu">
			<?php include_once(THEMA_PATH.'/menu-m.php');	// 메뉴 불러오기 ?>
		</div><!-- .m-menu -->
	</nav><!-- .at-menu -->

	<div class="clearfix"></div>
	
	<?php if($page_title) { // 페이지 타이틀 ?>
		<div class="at-title">
			<div class="at-container">
				<div class="page-title en">
					<strong<?php echo ($bo_table) ? " class=\"cursor\" onclick=\"go_page('".G5_BBS_URL."/board.php?bo_table=".$bo_table."');\"" : "";?>>
						<?php echo $page_title;?>
					</strong>
				</div>
				<?php if($page_desc) { // 페이지 설명글 ?>
					<div class="page-desc hidden-xs">
						<?php echo $page_desc;?>
					</div>
				<?php } ?>
				<div class="clearfix"></div>
			</div>
		</div>
	<?php } ?>

	<div class="at-body">
		<?php if($col_name) { ?>
		    <div class="at-container keyword-banner"><?php echo apms_widget('tto-oneline-msg', 'tto-oneline-msg'); // 한줄 메시지 ?></div>
			<div class="at-container">
			<?php if($col_name == "two") { ?>
			    
				<div class="row at-row">
					<div class="col-md-<?php echo $col_content;?><?php echo ($at_set['side']) ? ' pull-right' : '';?> at-col at-main">
					<div class="bbs-left-banner"><?php echo apms_widget('basic-banner-gallery', $wid.'-banner-main-left');?></div>
					<div class="widget-box widget-img">
				         <?php echo apms_widget('basic-banner-gallery', $wid.'-banner-alliance');?>
			        </div>		
			        <div class="bbs-right-banner"><?php echo apms_widget('basic-banner-gallery', $wid.'-banner-main-right');?></div>
			<?php } else { ?>
				<div class="at-content">
				
			<?php } ?>
		<?php } ?>
