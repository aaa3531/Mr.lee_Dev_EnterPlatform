<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키] 형태로 등록
// 모바일 설정값은 동일 배열키에 배열변수만 wmset으로 지정 → wmset[배열키]

?>

<div class="tbl_head01 tbl_wrap">
	<table>
	<caption>위젯설정</caption>
    <colgroup>
		<col class="grid_2">
		<col>
	</colgroup>
        <tbody>
            <tr>
		<td align="center">문구 입력</td>
		<td>
			<?php echo help('입력하고 싶은 문구를 아래에 입력해 주세요.');?>
			<textarea name="wset[q]" style="height:100px;"><?php echo $wset['q']; ?></textarea>
		</td>
	</tr>
        </tbody>
	</table>
</div>