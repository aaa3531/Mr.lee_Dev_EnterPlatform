<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;
use kr\c2\site as c2s;

$dir = $router->getDir();
$base_url = $router->buildURL();

$sc_idx = $input->get('sc_idx');
$page = $input->get('page');

$row = array(
    'sc_idx' => '',
    'sc_name' => '',
    'sc_login_refer' => '',
    'sc_login_url' => '',
    'sc_login_action' => '',
    'sc_uid_fld' => '',
    'sc_uid_val' => '',
    'sc_pwd_fld' => '',
    'sc_pwd_val' => '',
    'sc_list_url' => '',
    'sc_list_method' => '',
    'sc_list_data' => '',
    'sc_list_exp' => '',
    'sc_idx_url' => '',
    'sc_idx_title' => '',
    'sc_exps' => '',
    'sc_spage' => '',
    'sc_epage' => '',
    'sc_enctype' => '',
    'sc_delay' => '',
    'sc_use_origin' => '',
    'sc_proxy' => '',
    'sc_proxy_uid' => '',
    'sc_proxy_pwd' => '',
    'sc_agent' => '',
    'sc_skipstr' => '',
    'sc_nodnimg' => '',
    'sc_cate' => '',
    'sc_vrange' => '',
    'sc_overlap' => '',
    'sc_wm_use1' => '',
    'sc_wm_use2' => '',
    'sc_repstr' => '',
    'sc_user_list' => '',
    'sc_wm_pos1' => '',
    'sc_wm_pos2' => '',
    'sc_wm_padding1' => '',
    'sc_wm_padding2' => '',
    'sc_img_maxw' => '',
    'sc_img_maxh' => '',
    'sc_cmt_url' => '',
    'sc_cmt_exp' => '',
    'sc_cmt_reverse' => '',
    'sc_idx_cwriter' => '',
    'sc_idx_cdate' => '',
    'sc_idx_cgood' => '',
    'sc_idx_cnogood' => '',
    'sc_idx_ccontent' => '',
    'sc_use' => '',
    'sc_step' => '',
    'board' => ''
);
$exps = array();
$exp_subject = '';
$exp_content = '';

if(c2\isval($sc_idx)) {
    $act = 'edit';
    $row = $db->select("*")
        ->table("source")
        ->where("sc_idx=?", $sc_idx)
        ->query()->fetch(\PDO::FETCH_ASSOC);
        
    //항목/정규식 정리
    if(c2\isval($row["sc_exps"])){
        $exps = json_decode($row["sc_exps"], true);
        if (!is_array($exps)) $exps = array();
    }
    
    //제목과 내용은 따로 뺌
    $exp_subject = $exps["subject"];
    $exp_content = $exps["content"];
    unset($exps["subject"]);
    unset($exps["content"]);
    
    //중복체크값
    $st_overlap = explode("|", $row["sc_overlap"]);
    
} else {
    $act = 'new';
}

$a_tool_link = <<< HEREDOC
    <div class="btn-group my-1" role="group">
        <button type="button" class="btn-exp-tool btn btn-sm btn-primary">정규표현식 도구</button>
        <a href="http://www.weitz.de/regex-coach/" class="btn btn-sm btn-secondary" target="_blank">The Regex Coach 다운로드</a>
        <a href="https://regex101.com/" class="btn btn-sm btn-success" target="_blank">Online 정규식 도구</a>
    </div>
HEREDOC;

$c2['title'] = '소스관리 - 편집';
$mm = 1;
include(PATH_LAYOUT.'/default.head.php');

$htmlheader->addScript($router->getRealURL().'/js/forms.js');
?>
    <div class="container source-forms">
        <ul id="formTabs" class="nav nav-tabs nav-sm">
            <li class="nav-item">
                <a
                    id="tab_base"
                    class="nav-link active"
                    data-toggle="tab"
                    href="#c_base"
                >기본설정</a>
            </li>
            <li class="nav-item">
                <a
                    id="tab_member"
                    class="nav-link"
                    data-toggle="tab"
                    href="#c_member"
                    id="tab_member"
                >회원로그인</a>
            </li>
            <!--<li class="nav-item">
                <a
                    id="tab_list"
                    class="nav-link"
                    data-toggle="tab"
                    href="#c_list"
                >목록파싱설정</a>
            </li>
            <li class="nav-item">
                <a
                    id="tab_content"
                    class="nav-link"
                    data-toggle="tab"
                    href="#c_content"
                >본문파싱설정</a>
            </li>-->
            <li class="nav-item">
                <a
                    id="tab_cmt"
                    class="nav-link"
                    data-toggle="tab"
                    href="#c_cmt"
                >댓글파싱설정</a>
            </li>
            <li class="nav-item">
                <a
                    id="tab_etc"
                    class="nav-link"
                    data-toggle="tab"
                    href="#c_etc"
                >기타설정</a>
            </li>
        </ul>
        
        <form id="frm_forms">
            <input type="hidden" name="act" id="act" value="<?php echo $act?>">
            <input type="hidden" name="sc_idx" id="sc_idx" value="<?php echo $sc_idx?>">
            <div class="tab-content" id="fomTabsContent">
                <div class="tab-pane fade show active" id="c_base">
                    <?php include($dir.'/inc/form_base.php');?>
                </div>
                <div class="tab-pane fade" id="c_member">
                    <?php include($dir.'/inc/form_member.php');?>
                </div>
                <div class="tab-pane fade" id="c_cmt">
                    <?php include($dir.'/inc/form_comment.php');?>
                </div>
                <div class="tab-pane fade" id="c_etc">
                    <?php include($dir.'/inc/form_etc.php');?>
                </div>
            </div>
            
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">저장하기</button>
                <a href="?mod=source&page=<?php echo $page?>" class="btn btn-dark">돌아가기</a>
            </div>
        </form>
    </div>
    
    
    <!-- 이 부분은 반드시 form 밖에 있어야 함 -->
    <div id="detail_fields_tpl" class="d-none">
        <div class="row">
            <div class="col-2">
                <button type="button" class="btn-up btn btn-sm btn-dark">▲</button>
                <button type="button" class="btn-dn btn btn-sm btn-dark">▼</button>
                <button type="button" class="btn-del btn btn-sm brn-dark">삭제</button>
            </div>
            <div class="col-2">
                <select name="sc_fld[]" class="sc-fld required form-control form-control-sm">
                    <?php echo $fld_s->getOption();?>
                </select>
            </div>
            <div class="col-8">
                <textarea name="sc_exp[]" class="sc-exp form-control form-control-sm"></textarea>
            </div>
        </div>
    </div>
    
    <div id="exp_val" style="display:none;">
    <?php
    foreach($exps as $key=>$value){
    ?>
        <input type="hidden" class="_fld" value="<?php echo $key?>">
        <textarea class="_exp"><?php echo htmlspecialchars($value)?></textarea>
    <?php }?>
    </div>
    <!-- //이 부분은 반드시 form 밖에 있어야 함 -->
    
<?php
include(PATH_LAYOUT.'/default.tail.php');