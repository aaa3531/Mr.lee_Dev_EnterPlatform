<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;
use kr\c2\site as c2s;

$jres = new c2\util\JsonResult();

//파라미터 검사
function checkExp(){
    global $jres;
    
    $input = c2\Input::getInstance();
    
    $arr = array(
        /*
        'URL 인덱스' => $_POST['sc_idx_url'],
        '제목 인덱스' => $_POST['sc_idx_title'],
        '카테고리 인덱스' => $input->post('sc_idx_cate"],
        '글작성자 인덱스' => $input->post('sc_idx_writer"],
        '조회수 인덱스' => $input->post('sc_idx_visit"],
        */
        '목록 URL 인덱스' => $input->post('sc_idx_url'),
        '목록 제목 인덱스' => $input->post('sc_idx_title'),
        '댓글 작성자 인덱스' => $input->post('sc_idx_cwriter'),
        '댓글 날짜 인덱스' => $input->post('sc_idx_cdate'),
        '댓글 추천 인덱스' => $input->post('sc_idx_cgood'),
        '댓글 비추천 인덱스' => $input->post('sc_idx_cnogood'),
        '댓글 내용 인덱스' => $input->post('sc_idx_ccontent'),
    );
    
    foreach($arr as $key => $val){
        if(trim($val) != '' && preg_match("~^(?:(?:\[[0-9]\]?)|[0-9])+$~isx", $val) <= 0){
            echo $jres->error('인덱스는 한자리 숫자만 입력해주세요 - {$key}');
            exit;
        }
    }
}


function getData() {
    $input = c2\Input::getInstance();
    
    $arr = array();
    
    $arr['sc_login_refer']     = $input->post('sc_login_refer');
    $arr['sc_login_url']       = $input->post('sc_login_url');
    $arr['sc_login_action']    = $input->post('sc_login_action');
    $arr['sc_uid_fld']         = $input->post('sc_uid_fld');
    $arr['sc_uid_val']         = $input->post('sc_uid_val');
    $arr['sc_pwd_fld']         = $input->post('sc_pwd_fld');
    $arr['sc_pwd_val']         = $input->post('sc_pwd_val');
    $arr['sc_name']            = $input->post('sc_name');
    $arr['sc_list_url']        = $input->post('sc_list_url');
    $arr['sc_list_method']     = $input->post('sc_list_method');
    $arr['sc_list_data']       = str_replace("&amp;", "&", $input->post('sc_list_data'));
    $arr['sc_list_exp']        = trim($input->post('sc_list_exp', '', false));
    $arr['sc_idx_url']         = $input->post('sc_idx_url');
    $arr['sc_idx_title']       = $input->post('sc_idx_title');
    $arr['sc_spage']           = $input->post('sc_spage', 1);
    $arr['sc_epage']           = $input->post('sc_epage', 1);
    $arr['sc_enctype']         = $input->post('sc_enctype');
    $arr['sc_delay']           = $input->post('sc_delay', 300);
    $arr['sc_use_origin']      = $input->post('sc_use_origin', 0);
    $arr['sc_proxy']           = $input->post('sc_proxy');
    $arr['sc_proxy_uid']       = $input->post('sc_proxy_uid');
    $arr['sc_proxy_pwd']       = $input->post('sc_proxy_pwd');
    $arr['sc_agent']           = $input->post('sc_agent');
    $arr['sc_skipstr']         = $input->post('sc_skipstr');
    $arr['sc_nodnimg']         = $input->post('sc_nodnimg');
    $arr['sc_cate']            = $input->post('sc_cate');
    $arr['sc_vrange']          = @implode("|", $input->post('sc_vrange'));
    $arr['sc_overlap']         = @implode("|", $input->post('sc_overlap'));
    $arr['sc_wm_use1']         = $input->post('sc_wm_use1', 0);
    $arr['sc_wm_use2']         = $input->post('sc_wm_use2', 0);
    $arr['sc_repstr']          = $input->post('sc_repstr', '', false);
    $arr['sc_user_list']       = $input->post('sc_user_list');
    $arr['sc_wm_pos1']         = $input->post('sc_wm_pos1', 0);
    $arr['sc_wm_pos2']         = $input->post('sc_wm_pos2', 0);
    $arr['sc_wm_padding1']     = $input->post('sc_wm_padding1', 0);
    $arr['sc_wm_padding2']     = $input->post('sc_wm_padding2', 0);
    $arr['sc_img_maxw']        = $input->post('sc_img_maxw', 800);
    $arr['sc_img_maxh']        = $input->post('sc_img_maxh', 5000);
    $arr['sc_cmt_url']         = trim($input->post('sc_cmt_url'));
    $arr['sc_cmt_exp']         = trim($input->post('sc_cmt_exp', '', false));
    $arr['sc_cmt_reverse']     = $input->post('sc_cmt_reverse', 0);
    $arr['sc_idx_cwriter']     = @preg_replace("~[^0-9]~", "", $input->post('sc_idx_cwriter'));
    $arr['sc_idx_cdate']       = @preg_replace("~[^0-9]~", "", $input->post('sc_idx_cdate'));
    $arr['sc_idx_cgood']       = @preg_replace("~[^0-9]~", "", $input->post('sc_idx_cgood'));
    $arr['sc_idx_cnogood']     = @preg_replace("~[^0-9]~", "", $input->post('sc_idx_cnogood'));
    $arr['sc_idx_ccontent']    = @preg_replace("~[^0-9]~", "", $input->post('sc_idx_ccontent'));
    $arr['board']              = $input->post('bo_table');
    
    
    //본문 정규식 정리
    $keys = array('sc_fld', 'sc_exp', 'sc_step');

    $flds = $input->post('sc_fld');
    $exps = $input->post('sc_exp', '', false);
    
    $exp_r = array();
    for($i=0;$i<count($flds);$i++){
        $key = $flds[$i];
        $exp_r[$key] = trim($exps[$i]);
    }
    $arr['sc_exps'] = json_encode($exp_r, JSON_UNESCAPED_UNICODE);
    return $arr;
}

$act = $input->request('act');

            
//신규등록    
if($act === 'new'){
    
    checkExp();
    
    $arr = getData();
    
    $sc_step = $db->select("max(sc_step) as sc_step")->table("source")->query()->fetchColumn(0);
    $arr['sc_use'] = 1;
    $arr['sc_step'] = $sc_step + 1;
    $arr['board'] = '';
    
    $db->insert("source", $arr);
    
    echo $jres->success();
    
//수정
}else if($act === 'edit'){
    
    checkExp();
    
    $arr = getData();
    $sc_idx = $input->post('sc_idx');
    
    if(!c2\isval($sc_idx)) {
        echo $jres->error('잘못된 접근입니다');
        exit;
    }
    
    $db->update("source", $arr, array("sc_idx=?", $sc_idx));
    
    echo $jres->success();
    
//삭제
}else if($act == "del"){
    
    $sc_idx = $input->post('sc_idx');
    
    if(!c2\isval($sc_idx)) {
        echo $jres->error('잘못된 접근입니다');
        exit;
    }
    
    $db->delete("source", "sc_idx=?", $sc_idx);
    
    echo $jres->success();
    

//선택수정
}else if($act == "list_edit"){
    
    $chk = $input->post('chk');
    $page = $input->post('page');
    
    if (!count($chk) > 0) {
        c2\alert_back("수정 하실 항목을 하나 이상 체크하세요.");
        exit;
    }
    
    for ($i=0; $i<count($chk); $i++) {
        
        // 실제 번호를 넘김
        $k = $chk[$i];
        
        $arr = array();
        $arr['board'] = $input->post('board')[$k];
        $arr['sc_enctype'] = $input->post('sc_enctype')[$k];
        $arr['sc_delay'] = $input->post('sc_delay')[$k];
        $arr['sc_step'] = $input->post('sc_step')[$k];
        $arr['sc_use'] = $input->post('sc_use')[$k];
        
        $db->update("source", $arr, array("sc_idx=?", $input->post('sc_idx')[$k]));
    }
    
    c2\go("?mod=source&page=".$page);

    
//선택삭제
}else if($act == "list_delete"){
    
    $chk = $input->post('chk');
    $sc_idx = $input->post('sc_idx');
    
    if (!count($chk) > 0) {
        c2\alert_back("삭제 하실 항목을 하나 이상 체크하세요.");
        exit;
    }
    
    $idxs = array();
    for ($i=0; $i<count($chk); $i++) {
        // 실제 번호를 넘김
        $k = $chk[$i];
        $idxs[] = $input->post('sc_idx')[$k];
    }
    
    $in_sql = $db->getStrWhereIn('sc_idx', $idxs);
    $db->delete("source", array($in_sql, $idxs));
    
    c2\go("?mod=source");
    
} else if ($act == 'copy') {
    
    $sc_idx = $input->post('sc_idx');
    $sc_name = $input->post('sc_name');
    $sc_list_url = $input->post('sc_list_url');
    
    $row = $db->select("*")
        ->table("source")
        ->where("sc_idx=?", $sc_idx)
        ->query()->fetch(\PDO::FETCH_ASSOC);
        
    foreach($row as $key=>$val){
        $row[$key] = addslashes($val);
    }
    
    $result = $db->query("SHOW COLUMNS FROM c2_source");
    
    $arr = array();
    $arr[] = "sc_name = '".$sc_name."'";
    $arr[] = "sc_list_url = '".$sc_list_url."'";
    $arr[] = "sc_use = 1";
    
    $exc_fields = array("sc_idx", "sc_name", "sc_list_url", "sc_use");
    
    while($rs = $result->fetch(\PDO::FETCH_ASSOC)){
        if(in_array($rs["Field"], $exc_fields)) continue;
        $arr[] = $rs["Field"]." = '".$row[$rs["Field"]]."'";
    }
    $insert_sql = implode(", ", $arr);
    $db->query("INSERT INTO c2_source SET ".$insert_sql);
    
    echo $jres->success('복사되었습니다');
}
