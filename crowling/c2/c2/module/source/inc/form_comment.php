<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;
use kr\c2\site as c2s;
?>

    <section id="form-comment">
        <div class="tbl_frm01 tbl_wrap">
            
            <div class="form-group row">
                <div class="offset-col-2 col-10">
                    <?php echo c2s\help("- 댓글이 페이징 처리되어 있을 경우 1페이지만 등록됩니다.")?>
                    <?php echo c2s\help("- 댓글의 제목등록은 지원되지 않습니다")?>
                    <?php echo c2s\help("- 비동기 ajax로 구현된 댓글은 지원되지 않습니다")?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label" for="sc_cmt_url">댓글 페이지 URL</label>
                <div class="col-10">
                    <input type="text" name="sc_cmt_url" id="sc_cmt_url" value="<?php echo htmlspecialchars($row['sc_cmt_url'])?>" class="sc_long_input form-control form-control-sm">
                    <?php echo c2s\help("댓글이 아이프레임으로 되어 있을 경우 해당 URL을 입력해 주세요")?>
                    <?php echo c2s\help("본문 url 내 변수의 값을 댓글 url 에 적용시켜야 할때 {{변수명}}형식으로 변경해 주세요")?>
                    <?php echo c2s\help("예)<br>본문 url: http://www.test1.com/view.php?<b>cate</b>=test&<b>idx</b>=1234 일 경우<br>
                    댓글 url: http://www.test1.com/comment.php?cate=<b>{{cate}}</b>&vidx=<b>{{idx}}</b>")?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label" for="sc_cmt_exp">정규표현식</label>
                <div class="col-10">
                    <textarea  name="sc_cmt_exp" id="sc_cmt_exp" class="form-control form-control-sm"><?php echo $row['sc_cmt_exp'] ?></textarea>
                    <?php echo $a_tool_link?>
                    <?php echo c2s\help('"~정규표현식~옵션" 형식으로 작성해주세요')?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">역순으로 등록</label>
                <div class="col-10">
                    <input type="checkbox" name="sc_cmt_reverse" id="sc_cmt_reverse" value="1" <?php echo $row["sc_cmt_reverse"]!=0 ? 'checked="checked"':"";?>>
                    <label for="sc_cmt_reverse">댓글을 역순으로 등록합니다</label>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">추출대상 인덱스</label>
                <div class="col-10">
                    <div class="form-group row">
                        <label class="col-2 col-form-label">작성자 인덱스</label>
                        <div class="col-10">
                            <input type="text" name="sc_idx_cwriter" value="<?php echo $row["sc_idx_cwriter"]?>" class="form-control form-control-sm form-control-inline text-right">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">날짜 인덱스</label>
                        <div class="col-10">
                            <input type="text" name="sc_idx_cdate" value="<?php echo $row["sc_idx_cdate"]?>" class="form-control form-control-sm form-control-inline text-right">
                            <?php echo c2s\help("이 항목이 없을 경우 현재시간으로 등록됩니다")?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">추천 인덱스</label>
                        <div class="col-10"><input type="text" name="sc_idx_cgood" value="<?php echo $row["sc_idx_cgood"]?>" class="form-control form-control-sm form-control-inline text-right"></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">비추천 인덱스</label>
                        <div class="col-10"><input type="text" name="sc_idx_cnogood" value="<?php echo $row["sc_idx_cnogood"]?>" class="form-control form-control-sm form-control-inline text-right"></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">내용 인덱스</label>
                        <div class="col-10"><input type="text" name="sc_idx_ccontent" value="<?php echo $row["sc_idx_ccontent"]?>" class="form-control form-control-sm form-control-inline text-right"></div>
                    </div>
                    <?php echo c2s\help("인덱스란 작성한 정규표현식에서 <b>괄호</b> \"(...)\"의 순서를 의미합니다.")?>
                    <?php echo c2s\help("첫번째 <b>괄호</b>가 1, 두번째 <b>괄호</b>가 2가 됩니다. 1~5까지 입력가능합니다")?>
                    <?php echo c2s\help("댓글의 정규식이 잘못 작성 되었을 경우 에러없이 원글만 등록됩니다.")?>
                    <?php echo c2s\help("내용 인덱스는 필수로 입력해 주셔야 합니다.")?>
                </div>
            </div>
        </div>
    </section>
