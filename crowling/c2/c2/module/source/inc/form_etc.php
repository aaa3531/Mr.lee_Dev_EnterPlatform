<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;
use kr\c2\site as c2s;

$agents = c2s\get_agents();
$a_s = new c2\html\Selectbox();
foreach($agents as $key=>$val){
    $a_s->add($key, $key);
}
$sc_vrange_s = '';
$sc_vrange_e = '';
if (is_array($row['sc_vrange'])) {
    list($sc_vrange_s, $sc_vrange_e) = explode('|', c2\varset($row['sc_vrange']));
}
?>
    <section class="form-etc">
        <div class="form-group row">
            <label class="col-2 col-form-label"><label>출처표시</label></label>
            <div class="col-10 form-check">
                <input type="checkbox" name="sc_use_origin" id="sc_use_origin" value="1" <?php echo $row["sc_use_origin"]!=0 ? 'checked="checked"':"";?>>
                <label for="sc_use_origin" class="form-check-label">출처자동삽입</label>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label"><label>프록시서버</label></label>
            <div class="col-10">
                <input type="text" name="sc_proxy" value="<?php echo $row["sc_proxy"]?>" size="30" class="form-control form-control-sm">
                <?php echo c2s\help("사용할때에만 입력해 주세요")?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label"><label>프록시 아이디</label></label>
            <div class="col-10">
                <input type="text" name="sc_proxy_uid" value="<?php echo $row["sc_proxy_uid"]?>" size="30" class="form-control form-control-sm">
                <?php echo c2s\help("사용할때에만 입력해 주세요")?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label"><label>프록시 비밀번호</label></label>
            <div class="col-10">
                <input type="text" name="sc_proxy_pwd" value="<?php echo $row["sc_proxy_pwd"]?>" size="30" class="form-control form-control-sm">
                <?php echo c2s\help("사용할때에만 입력해 주세요")?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label"><label>User Agent</label></label>
            <div class="col-10">
                <select name="sc_agent" class="form-control form-control-sm">
                    <?php echo $a_s->getOption();?>
                </select>
                <?php echo c2s\help("대상사이트의 서버에게 어떤 브라우저로 접근한 것인지 알려줍니다");?>
                <?php echo c2s\help("모바일과 PC의 내용이 다르게 출력되는 사이트의 경우 이 옵션을 활용해 주세요");?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label"><label>등록제외 문자열</label></label>
            <div class="col-10">
                <textarea name="sc_skipstr" class="form-control form-control-sm"><?php echo $row["sc_skipstr"]?></textarea>
                <?php echo c2s\help("입력한 문자열이 포함되어 있을경우 등록하지 않습니다");?>
                <?php echo c2s\help("여러개는 줄바꿈으로 구분해 주세요")?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label"><label>이미지 다운로드 옵션</label></label>
            <div class="col-10">
                <select name="sc_nodnimg" class="form-control form-control-sm">
                    <?php echo $i_s->getOption();?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label"><label>카테고리정의</label></label>
            <div class="col-10">
                <input type="text" name="sc_cate" value="<?php echo $row["sc_cate"]?>" size="20" class="form-control form-control-sm">
                <?php echo c2s\help("카테고리를 강제로 입력합니다. (파싱설정된 카테고리가 있으면 무시됩니다)")?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label"><label>조회수 랜덤범위</label></label>
            <div class="col-10">
                <input type="text" name="sc_vrange[]" value="<?php echo $sc_vrange_s?>" size="10" class="form-control form-control-sm form-control-inline text-center" placeholder="숫자만 입력">
                -
                <input type="text" name="sc_vrange[]" value="<?php echo $sc_vrange_e?>" size="10" class="form-control form-control-sm form-control-inline text-center" placeholder="숫자만 입력">
                <?php echo c2s\help("입력한 숫자 범위 내에서 랜덤으로 조회수가 입력됩니다")?>
                <?php echo c2s\help("파싱설정으로 가져온 조회수가 있을 경우에는 무시됩니다")?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label"><label>자동등록 게시판</label></label>
            <div class="col-10">
                <select name="bo_table" class="form-control form-control-sm">
                    <option value="">=선택안함=</option>
                    <?php echo $b_s->getOption()?>
                </select>
                <?php echo c2s\help("자동수집기능을 사용할 경우 선택한 게시판에 등록이 됩니다")?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label"><label for="sc_repstr">문자열 치환</label></label>
            <div class="col-10">
                <textarea name="sc_repstr" id="sc_repstr" class="form-control"><?php echo $row["sc_repstr"]?></textarea>
                <?php echo c2s\help("특정문자열을 임의의 문자열로 치환합니다");?>
                <?php echo c2s\help("치환이 적용되는 필드는 카테고리, 제목, 본문, 파일명, 댓글 입니다");?>
                <?php echo c2s\help("<b>\"대상문자열|바꿀문자열\"</b> 형식으로 입력해주세요.");?>
                <?php echo c2s\help("<b>\"대상문자열|\"</b> 와 같이 바꿀문자열을 생략하면 대상문자열이 삭제됩니다.");?>
                <?php echo c2s\help("정규식으로 치환하실때에는 <b>\"~정규표현식~옵션|바꿀문자열\"</b> 형식으로 작성해주세요.");?>
                <?php echo c2s\help("기본설정의 문자열 치환에 추가됩니다")?>
                <?php echo c2s\help("여러개는 줄바꿈으로 구분합니다");?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label"><label for="sc_user_list">글작성자</label></label>
            <div class="col-10">
                <textarea name="sc_user_list" id="sc_user_list" class="form-control"><?php echo $row["sc_user_list"]?></textarea>
                <?php echo c2s\help("입력한 작성자가 실제 회원아이디와 일치할 경우 해당 회원명의로 등록됩니다");?>
                <?php echo c2s\help("여러명을 등록할때는 줄바꿈으로 구분합니다")?>
                <?php echo c2s\help("여러명을 등록했을 경우 랜덤으로 선택이 됩니다")?>
                <?php echo c2s\help("기본설정값보다 우선순위에 있습니다")?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label"><label>이미지 크기제한</label></label>
            <div class="col-10">
                <input type="text" name="sc_img_maxw" id="sc_img_maxw" value="<?php echo $row['sc_img_maxw']?>" class="form-control form-control-sm form-control-inline text-right" size="4" placeholder="가로(px)">
                X
                <input type="text" name="sc_img_maxh" id="sc_img_maxh" value="<?php echo $row['sc_img_maxh']?>" class="form-control form-control-sm form-control-inline text-right" size="4" placeholder="세로(px)">
            </div>
        </div>
        
        <div class="form-group row">
            <label class="col-2 col-form-label">워터마크1</label>
            <div class="col-10 form-check">
                <input type="checkbox" name="sc_wm_use1" id="sc_wm_use1" value="1"<?php echo $row['sc_wm_use1']=='1' ?' checked="checked"':'';?>>
                <label for="sc_wm_use" class="form-check-label">사용함</label>
                <table class="table table-bordered" style="max-width: 300px;">
                <tbody>
                <tr>
                    <td class="text-center"><?php echo c2s\get_watermark_pos(c2\image\Thumbnail::WM_LEFT_TOP, "sc_wm_pos1", $row["sc_wm_pos1"])?> 좌상</td>
                    <td class="text-center"><?php echo c2s\get_watermark_pos(c2\image\Thumbnail::WM_CENTER_TOP, "sc_wm_pos1", $row["sc_wm_pos1"])?> 중상</td>
                    <td class="text-center"><?php echo c2s\get_watermark_pos(c2\image\Thumbnail::WM_RIGHT_TOP, "sc_wm_pos1", $row["sc_wm_pos1"])?> 우상</td>
                </tr>
                <tr>
                    <td class="text-center"><?php echo c2s\get_watermark_pos(c2\image\Thumbnail::WM_LEFT_MIDDLE, "sc_wm_pos1", $row["sc_wm_pos1"])?> 좌중</td>
                    <td class="text-center"><?php echo c2s\get_watermark_pos(c2\image\Thumbnail::WM_CENTER_MIDDLE, "sc_wm_pos1", $row["sc_wm_pos1"])?> 중중</td>
                    <td class="text-center"><?php echo c2s\get_watermark_pos(c2\image\Thumbnail::WM_RIGHT_MIDDLE, "sc_wm_pos1", $row["sc_wm_pos1"])?> 우중</td>
                </tr>
                <tr>
                    <td class="text-center"><?php echo c2s\get_watermark_pos(c2\image\Thumbnail::WM_LEFT_BOTTOM, "sc_wm_pos1", $row["sc_wm_pos1"])?> 좌하</td>
                    <td class="text-center"><?php echo c2s\get_watermark_pos(c2\image\Thumbnail::WM_CENTER_BOTTOM, "sc_wm_pos1", $row["sc_wm_pos1"])?> 중하</td>
                    <td class="text-center"><?php echo c2s\get_watermark_pos(c2\image\Thumbnail::WM_RIGHT_BOTTOM, "sc_wm_pos1", $row["sc_wm_pos1"])?> 우하</td>
                </tr>
                </tbody>
                </table>
                <div style="margin:4px 0">
                    <label>가장자리로부터의 여백:</label>
                    <input type="text" name="sc_wm_padding1" id="sc_wm_padding1"
                        value="<?php echo $row['sc_wm_padding1']?>"
                        class="form-control form-control-sm form-control-inline text-center"
                        size="10" placeholder="숫자만 입력">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label">워터마크2</label>
            <div class="col-10 form-check">
                <input type="checkbox" name="sc_wm_use2" id="sc_wm_use2" value="1"<?php echo $row['sc_wm_use2']=='1' ?' checked="checked"':'';?>>
                <label for="sc_wm_use" class="form-check-label">사용함</label>
                <table class="table table-bordered" style="max-width: 300px;">
                <tbody>
                <tr>
                    <td class="text-center"><?php echo c2s\get_watermark_pos(c2\image\Thumbnail::WM_LEFT_TOP, "sc_wm_pos2", $row["sc_wm_pos2"])?> 좌상</td>
                    <td class="text-center"><?php echo c2s\get_watermark_pos(c2\image\Thumbnail::WM_CENTER_TOP, "sc_wm_pos2", $row["sc_wm_pos2"])?> 중상</td>
                    <td class="text-center"><?php echo c2s\get_watermark_pos(c2\image\Thumbnail::WM_RIGHT_TOP, "sc_wm_pos2", $row["sc_wm_pos2"])?> 우상</td>
                </tr>
                <tr>
                    <td class="text-center"><?php echo c2s\get_watermark_pos(c2\image\Thumbnail::WM_LEFT_MIDDLE, "sc_wm_pos2", $row["sc_wm_pos2"])?> 좌중</td>
                    <td class="text-center"><?php echo c2s\get_watermark_pos(c2\image\Thumbnail::WM_CENTER_MIDDLE, "sc_wm_pos2", $row["sc_wm_pos2"])?> 중중</td>
                    <td class="text-center"><?php echo c2s\get_watermark_pos(c2\image\Thumbnail::WM_RIGHT_MIDDLE, "sc_wm_pos2", $row["sc_wm_pos2"])?> 우중</td>
                </tr>
                <tr>
                    <td class="text-center"><?php echo c2s\get_watermark_pos(c2\image\Thumbnail::WM_LEFT_BOTTOM, "sc_wm_pos2", $row["sc_wm_pos2"])?> 좌하</td>
                    <td class="text-center"><?php echo c2s\get_watermark_pos(c2\image\Thumbnail::WM_CENTER_BOTTOM, "sc_wm_pos2", $row["sc_wm_pos2"])?> 중하</td>
                    <td class="text-center"><?php echo c2s\get_watermark_pos(c2\image\Thumbnail::WM_RIGHT_BOTTOM, "sc_wm_pos2", $row["sc_wm_pos2"])?> 우하</td>
                </tr>
                </tbody>
                </table>
                <div style="margin:4px 0">
                    <label>가장자리로부터의 여백:</label>
                    <input type="text" name="sc_wm_padding2" id="sc_wm_padding2"
                        value="<?php echo $row['sc_wm_padding2']?>"
                        class="form-control form-control-sm form-control-inline text-center"
                        size="10" placeholder="숫자만 입력">
                </div>
            </div>
        </div>
    </section>
