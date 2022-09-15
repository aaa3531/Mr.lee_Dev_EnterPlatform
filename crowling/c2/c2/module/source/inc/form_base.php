<?php

if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;
use kr\c2\site as c2s;

//enctype
$e_s = new c2\html\Selectbox();
if (c2\isval($row['sc_enctype']))
    $e_s->selectedFromValue = $row['sc_enctype'];
$e_s->add("utf-8", "UTF-8");
$e_s->add("euc-kr", "EUC-KR");
foreach($c2cfg['cf_enctype_list'] as $key => $value){
    if(trim($value)=='') continue;
    $e_s->add($value, strtoupper($value));
}

$i_s = new c2\html\Selectbox();
if (c2\isval($row['sc_nodnimg']))
    $i_s->selectedFromValue = $row['sc_nodnimg'];

$i_s->add("0", "다운로드 후 본문에 표시");
$i_s->add("1", "다운로드 하지 않고 링크로 본문에 표시");
$i_s->add("2", "이미지는 내용에서 제외함");
$i_s->add("3", "imgur.com 로 업로드 (기본설정에서 api세팅 필요)");

$lm_s = new c2\html\Selectbox();
if (c2\isval($row['sc_list_method']))
    $lm_s->selectedFromValue = $row['sc_list_method'];
$lm_s->add('GET', 'GET');
$lm_s->add('POST', 'POST');


$poster = c2s\Target::getInstance()->getPoster();

//게시판 목록
$blist = $poster->fetchAll();

$b_s = new c2\html\Selectbox();
foreach($blist as $key => $val){
    $b_s->add($key, $val);
}

$fld_arr = $poster->getFields();

$fld_s = new c2\html\Selectbox();
foreach($fld_arr as $key => $val){
    $fld_s->add($key, $val);
}
?>
    <section>
        <div class="card mb-3">
            <div class="card-header">기본</div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-2 col-form-label"><label for="sc_name">소스 명(필수)</label></label>
                    <div class="col-10">
                        <input type="text"
                            id="sc_name"
                            name="sc_name" 
                            value="<?php echo $row['sc_name'] ?>" 
                            required="required"
                            data-c2val="required:true,label:'소스이름'"
                            class="form-control form-control-sm" size="30">
                    </div>        
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label"><label>엔코딩타입(필수)</label></label>
                    <div class="col-10">
                        <select name="sc_enctype" class="form-control form-control-sm" required="required">
                            <?php echo $e_s->getOption()?>
                        </select>
                        <?php echo c2s\help("대상 사이트의 엔코딩타입을 지정해 주세요");?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label"><label>딜레이(필수)</label></label>
                    <div class="col-10">
                        <input type="text"
                            name="sc_delay"
                            value="<?php echo $row["sc_delay"]?>"
                            size="10"
                            data-c2val="required:true,numeric:true,label:'딜레이'"
                            class="required form-control form-control-sm form-control-inline text-right">
                        <?php echo c2s\help("한개의 글을 수집 후 지정된 <strong>시간(MilliSecond)</strong>만큼 쉬고 또 진행합니다(1초 = 1000)")?>
                        <?php echo c2s\help("대상사이트에 부하가 생기지 않도록 최소 0.5초(500) 이하로는 작동되지 않도록 설정되어 있습니다")?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mb-3">
            <div class="card-header">목록수집설정</div>
            <div class="card-body">
        
                <div class="form-group row">
                    <label class="col-2 col-form-label" for="sc_list_url">목록 페이지 URL(필수)</label>
                    <div class="col-10">
                        <input type="text"
                            id="sc_list_url"
                            name="sc_list_url"
                            data-c2val="required:true,label:'목록페이지URL'"
                            value="<?php echo htmlspecialchars($row['sc_list_url'])?>"
                            class="sc_long_input form-control form-control-sm">
                        <?php echo c2s\help("컨텐츠 목록페이지의 URL을 입력해 주세요.")?>
                        <?php echo c2s\help("URL문자열에서 페이지번호에 해당하는 부분(예: page=1)은 page={{page}} 형식으로 변경해주세요.")?>
                        <?php echo c2s\help("원본 예) http://www.test1.com/board.php?page=1")?>
                        <?php echo c2s\help("수정 예) http://www.test1.com/board.php?page={{page}}")?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label" for="sc_list_method">Http 메소드(필수)</label>
                    <div class="col-10">
                        <select name="sc_list_method" class="form-control form-control-sm" required="required">
                            <?php echo $lm_s->getOption();?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label" for="sc_list_data">목록 요청시 추가데이타</label>
                    <div class="col-10">
                        <textarea name="sc_list_data"
                            id="sc_list_data"
                            class="form-control"><?php echo htmlspecialchars($row['sc_list_data']) ?></textarea>
                        <?php echo c2s\help("POST 방식일 경우 추가로 입력되어야 할 데이타가 있으면 입력해주세요")?>
                        <?php echo c2s\help("QustringString 방식으로 입력하면 됩니다")?>
                        <?php echo c2s\help("예) nation=korea&what=smile")?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label" for="sc_list_exp">정규표현식(*)</label>
                    <div class="col-10">
                        <textarea
                            id="sc_list_exp"
                            name="sc_list_exp"
                            data-c2val="required:true,label:'목록정규식'"
                            class="form-control"><?php echo htmlspecialchars($row['sc_list_exp']) ?></textarea>
                        <?php echo $a_tool_link?>
                        <?php echo c2s\help('- "~정규표현식~옵션" 형식으로 작성해주세요')?>
                        <?php echo c2s\help('- 정규식 괄호의 순서대로 데이타로 사용됩니다')?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">추출대상 번호(필수)</label>
                    <div class="col-10">
                        <label for="sc_idx_url">URL: </label>
                        <input type="text"
                            name="sc_idx_url"
                            value="<?php echo $row["sc_idx_url"]?>"
                            size="5"
                            required="required"
                            data-c2val="required:true,numeric:true,label:'본문링크 URL 인덱스'"
                            class="form-control form-control-sm form-control-inline text-center"
                            placeholder="본문링크 URL 인덱스">
                        <label for="sc_idx_title">제목: </label>
                        <input type="text"
                            name="sc_idx_title"
                            data-c2val="required:true,numeric:true,label:'제목 인덱스'"
                            value="<?php echo $row["sc_idx_title"]?>"
                            size="5"
                            class="form-control form-control-sm form-control-inline text-center"
                            placeholder="제목 인덱스">
                        <?php echo c2s\help("상단의 작성한 정규표현식에서 <b>괄호</b> \"(...)\"의 순서를 의미합니다.")?>
                        <?php echo c2s\help("URL에 해당하는 괄호가 첫번째에 있으면 1, 제목에 해당하는 괄호가 두번째에 있으면 2가 됩니다")?>
                        <?php echo c2s\help("첫번째 <b>괄호</b>가 1, 두번째 <b>괄호</b>가 2가 됩니다.")?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">수집페이지(필수)</label>
                    <div class="col-10">
                        <input type="text" name="sc_spage" value="<?php echo $row["sc_spage"]?>" required
                            class="required form-control form-control-sm form-control-inline text-center"
                            data-c2val="required:true,numeric:true,label:'대상페이지'"
                            size="5" placeholder="Page">
                        ~
                        <input type="text" name="sc_epage" value="<?php echo $row["sc_epage"]?>" required
                            class="required form-control form-control-sm form-control-inline text-center"
                            data-c2val="required:true,numeric:true,label:'대상페이지'"
                            size="5" placeholder="Page">
                        <?php echo c2s\help("수집할 페이지의 범위를 설정합니다")?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mb-3">
            <div class="card-header">내용수집설정</div>
            <div class="card-body">
                <div class="tbl_frm01 tbl_wrap">
                    
                    <div class="form-group row">
                        <label class="col-2 col-form-label">중복체크 방법</label>
                        <div class="col-10">
                            <div class="d-flex flex-wrap">
                                <?php
                                $sc_overlap = explode("|", $row["sc_overlap"]);
                                for($i=0; $item=each($fld_arr); $i++){
                                ?>
                                    <label class="overlap-field-item mr-2">
                                        <input type="checkbox" name="sc_overlap[]" id="sc_overlap_<?php echo $i?>" value="<?php echo $item["key"]?>"<?php echo in_array($item["key"], $sc_overlap) ? 'checked="checked"':'';?>>
                                        <?php echo $item["value"]?>
                                    </label>
                                <?php }?>
                            </div>
                            <?php echo c2s\help("선택된 필드의 내용을 합쳐서 고유의 키를 만들어 중복체크키로 저장합니다")?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            입력항목 / 정규식
                        </label>
                        <div class="col-10">
                        
                            <div class="field-wrap">
                                <?php echo c2s\help('저장될 필드를 선택하시고 추출할 데이타의 정규표현식을 입력해주세요')?>
                                <?php echo c2s\help('"~정규표현식~옵션" 형식으로 작성해주세요. 정규표현식내의 <b>괄호</b>부분이 데이타가 됩니다')?>
                                <?php echo c2s\help('줄바꿈으로 두개 이상의 정규표현식을 입력하시면 해당부분이 합쳐져서 저장됩니다')?>
                                <?php echo $a_tool_link?>
                                <div class="my-3">
                                    <button type="button" id="btn_add_field" class="btn btn-sm btn-dark">추가하기</button>
                                </div>
                                <div class="row">
                                    <div class="col-2">순서 / 삭제</div>
                                    <div class="col-2">필드명</div>
                                    <div class="col-8">정규표현식</div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <input type="text" name="sc_step[]" value="1" readonly="readonly" size="2" class="form-control form-control-sm form-control-inline">
                                    </div>
                                    <div class="col-2">
                                        <input type="hidden" name="sc_fld[]" value="subject">
                                        제목
                                    </div>
                                    <div class="col-8">
                                        <textarea name="sc_exp[]" class="form-control form-control-sm"><?php echo htmlspecialchars($exp_subject)?></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <input type="text" name="sc_step[]" value="2" readonly="readonly" size="2" class="form-control form-control-sm form-control-inline">
                                    </div>
                                    <div class="col-2">
                                        <input type="hidden" name="sc_fld[]" value="content">
                                        본문내용
                                    </div>
                                    <div class="col-8">
                                        <textarea name="sc_exp[]" class="form-control form-control-sm"><?php echo htmlspecialchars($exp_content)?></textarea>
                                    </div>
                                </div>
                                
                                <div id="detail_fields">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>