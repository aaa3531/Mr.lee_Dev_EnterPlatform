<?php
include_once('./_common.php');
include_once('./header.php');
?>
<style>
	.page-content { line-height:22px; word-break: keep-all; word-wrap: break-word; }
	.page-content .article-title { color:#0083B9; font-weight:bold; padding-top:30px; padding-bottom:10px; }
	.page-content ul { list-style:none; padding:0px; margin:0px; font-weight:normal; }
	.page-content ol { margin-top:0px; margin-bottom:15px; }
	.page-content p { margin:0 0 15px; padding:0; }
	.page-content table { border-top:2px solid #999; border-bottom:1px solid #ddd; }
	.page-content th, 
	.page-content td { line-height:1.6 !important; }
	.page-content table.tbl-center th,
	.page-content table.tbl-center td,
	.page-content th.text-center, 
	.page-content td.text-center { text-align:center !important; }
</style>
<div class="page-content sportslive">
    <?php if(!$header_skin) { // 헤더 미사용시 출력 ?>
		<div class="text-center" style="margin:15px 0px;">
			<h3 class="div-title-underline-bold border-color">
				스포츠 중계
			</h3>
		</div>
	<?php } ?>
	<iframe src='http://netwiztv.com/mantang/' style='overflow-x:hidden' scrolling='yes' width='100%' height='4000' allowfullscreen='true'  frameborder='0' webkitallowfullscreen='true' mozallowfullscreen='true'></iframe>
</div>
<div class="h30"></div>
<?php
include_once('./_tail.php');
?>