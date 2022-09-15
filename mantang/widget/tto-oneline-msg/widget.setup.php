<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키] 형태로 등록
// 모바일 설정값은 동일 배열키에 배열변수만 wmset으로 지정 → wmset[배열키]
?>
<script>
$(document).ready(function () { // 캐시 미사용  - 관련 텍스트 미출력 위한
	$('label:last').html('<label><input type="checkbox" name="del" value="1"> 위젯 초기화</label>');
});
</script>

<div class="tbl_head01 tbl_wrap">
	<table>
	<caption>위젯설정</caption>
	<colgroup>
		<col class="grid_2">
		<col>
	</colgroup>
	<thead>
	<tr>
		<th scope="col">구분</th>
		<th scope="col">설정</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td align="center">글자색</td>
		<td>
			<select name="wset[msg_color]">
				<?php echo apms_color_options($wset['msg_color']);?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">한줄 메시지</td>
		<td>
			<?php echo help('엔터로 구분하여 복수 등록 가능');?>
			<textarea name="wset[oneline_msg]" style="width:95%;height:300px;"><?php echo $wset['oneline_msg']; ?></textarea>
		</td>
	</tr>
	</tbody>
	</table>
</div>