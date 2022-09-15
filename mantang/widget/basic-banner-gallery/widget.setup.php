<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키] 형태로 등록
// 모바일 설정값은 동일 배열키에 배열변수만 wmset으로 지정 → wmset[배열키]

// 추출하기
if(!$wset['rows']) {
	$wset['rows'] = 4;
}
?>

<div class="tbl_head01 tbl_wrap">
	<table>
	<caption>위젯설정</caption>
	<colgroup>
		<col class="grid_2">
		<col>
	</colgroup>
	<thead>
	<tr>
		<th scope="col" colspan="2">구분</th>
		<th scope="col">설정</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td align="center" rowspan="5">공통</td>
		<td align="center">스타일</td>
		<td>
			<select name="wset[caption]">
				<option value=""<?php echo get_selected('', $wset['caption']);?>>캡션없음</option>
				<option value="1"<?php echo get_selected('1', $wset['caption']);?>>캡션숨김</option>
				<option value="2"<?php echo get_selected('2', $wset['caption']);?>>일반캡션</option>
				<option value="3"<?php echo get_selected('3', $wset['caption']);?>>호버캡션</option>
			</select>
			&nbsp;
			<label><input type="checkbox" name="wset[masonry]" value="1"<?php echo get_checked('1', $wset['masonry']); ?>> 메이슨리 모드</label>
			&nbsp;
			<label><input type="checkbox" name="wset[thumb_no]" value="1"<?php echo get_checked('1', $wset['thumb_no']);?>> 원본출력</label>
			&nbsp;
			<label><input type="checkbox" name="wset[lb]" value="1"<?php echo get_checked('1', $wset['lb']);?>> 라이트박스</label>
		</td>
	</tr>
	<tr>
		<td align="center">제목스타일</td>
		<td>
			<input type="text" name="wset[line]" value="<?php echo $wset['line']; ?>" class="frm_input" size="4"> 줄(기본 1)
			&nbsp;
			<label><input type="checkbox" name="wset[center]" value="1"<?php echo get_checked('1', $wset['center']); ?>> 가운데</label>
			&nbsp;
			<label><input type="checkbox" name="wset[bold]" value="1"<?php echo get_checked('1', $wset['bold']); ?>> 볼드체</label>
		</td>
	</tr>
	<tr>
		<td align="center">썸네일</td>
		<td>
			<?php echo help('기본 300x250(16:9) - 미입력시 기본값 적용');?>
			<input type="text" name="wset[thumb_w]" value="<?php echo $wset['thumb_w']; ?>" class="frm_input" size="4">
			x
			<input type="text" name="wset[thumb_h]" value="<?php echo $wset['thumb_h']; ?>" class="frm_input" size="4">
			px
			&nbsp;
			<select name="wset[shadow]">
				<?php echo apms_shadow_options($wset['shadow']);?>
			</select>
			&nbsp;
			<label><input type="checkbox" name="wset[inshadow]" value="1"<?php echo get_checked('1', $wset['inshadow']); ?>> 내부그림자</label>
		</td>
	</tr>
	<tr>
		<td align="center">출력배너수</td>
		<td>
			<input type="text" name="wset[rows]" value="<?php echo $wset['rows']; ?>" class="frm_input" size="4"> 개 - PC
			&nbsp;
			<input type="text" name="wmset[rows]" value="<?php echo $wmset['rows']; ?>" class="frm_input" size="4"> 개 - 모바일
			&nbsp;
			추출
		</td>
	</tr>
	<tr>
		<td align="center">반응형</td>
		<td>
			<table>
			<thead>
			<tr>
				<th scope="col">구분</th>
				<th scope="col">기본</th>
				<th scope="col">lg(1199px~)</th>
				<th scope="col">md(991px~)</th>
				<th scope="col">sm(767px~)</th>
				<th scope="col">xs(480px~)</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td align="center">가로갯수(개)</td>
				<td align="center">
					<input type="text" name="wset[item]" value="<?php echo $wset['item']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[lg]" value="<?php echo $wset['lg']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[md]" value="<?php echo $wset['md']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[sm]" value="<?php echo $wset['sm']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[xs]" value="<?php echo $wset['xs']; ?>" class="frm_input" size="4">
				</td>
			</tr>
			<tr>
				<td align="center">좌우간격(px)</td>
				<td align="center">
					<input type="text" name="wset[gap]" value="<?php echo $wset['gap']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[lgg]" value="<?php echo $wset['lgg']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[mdg]" value="<?php echo $wset['mdg']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[smg]" value="<?php echo $wset['smg']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[xsg]" value="<?php echo $wset['xsg']; ?>" class="frm_input" size="4">
				</td>
			</tr>
			<tr>
				<td align="center">상하간격(px)</td>
				<td align="center">
					<input type="text" name="wset[gapb]" value="<?php echo $wset['gapb']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[lgb]" value="<?php echo $wset['lgb']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[mdb]" value="<?php echo $wset['mdb']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[smb]" value="<?php echo $wset['smb']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[xsb]" value="<?php echo $wset['xsb']; ?>" class="frm_input" size="4">
				</td>
			</tr>
			</tbody>
			</table>
		</td>
	</tr>
	<?php for ($i=1; $i <= $wset['rows']; $i++) { ?>
		<tr>
			<td align="center" rowspan="4">#<?php echo $i;?></td>
			<td align="center" class="bg-light"><b>사용여부</b></td>
			<td class="bg-light">
				<label><input type="checkbox" name="wset[use<?php echo $i;?>]" value="1"<?php echo get_checked('1', $wset['use'.$i]); ?>> <b>출력하기</b></label>
			</td>
		</tr>
		<tr>
			<td align="center">이미지</td>
			<td>
				<input type="text" name="wset[img<?php echo $i;?>]" value="<?php echo ($wset['img'.$i]);?>" id="img<?php echo $i;?>" size="40" class="frm_input">
				<a href="<?php echo G5_BBS_URL;?>/widget.image.php?fid=img<?php echo $i;?>" class="btn_frmline win_scrap">이미지선택</a>
			</td>
		</tr>
		<tr>
			<td align="center">배너 타이틀</td>
			<td>
				<input type="text" name="wset[subject<?php echo $i;?>]" value="<?php echo $wset['subject'.$i]; ?>" size="40" class="frm_input">
				&nbsp;
			</td>
		</tr>
		<tr>
			<td align="center">링크</td>
			<td>
				<?php echo help('URL(http://...)을 입력해야 하며, 미입력시 링크가 걸리지 않습니다.');?>
				<input type="text" name="wset[link<?php echo $i;?>]" value="<?php echo $wset['link'.$i]; ?>" size="30" class="frm_input" placeholder="http://...">
				&nbsp;
				타켓
				<input type="text" name="wset[target<?php echo $i;?>]" value="<?php echo $wset['target'.$i]; ?>" size="8" class="frm_input">
			</td>
		</tr>
	<?php } ?>
	</tbody>
	</table>
</div>