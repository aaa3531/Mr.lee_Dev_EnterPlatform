<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;
use kr\c2\site as c2s;

//===========================================================================
// 환경설정
//===========================================================================

$cfg = c2s\get_config();

//타임아웃 세팅
if(!isset($cfg["cf_timeout"])) $cfg["cf_timeout"] = 120;
set_time_limit($cfg["cf_timeout"]);

//메모리 한도 세팅
if(!isset($cfg["cf_memory_limit"])){
    $cfg["cf_memory_limit"] = "50";
    //ini_set("memory_limit", $cfg["cf_memory_limit"]."M");
    echo '1';
}

//결과출력 컨테이너
$jres = new c2\util\JsonResult();

//===========================================================================
// 파라미터 확인
//===========================================================================
$sc_idx = $input->post('sc_idx');
$page = $input->post('page');

if(!c2\isval($sc_idx) || !c2\isval($page)){
    echo $jres->error('값이 제대로 전달되지 않았습니다');
    exit;
}

//===========================================================================
// 리스트 크롤러 실행
//===========================================================================
$lc = new c2s\ListCrawler();
try{
    $source = $db->select("*")
        ->table("source")
        ->where("sc_idx=?", $sc_idx)
        ->query()->fetch(\PDO::FETCH_ASSOC);

    if(!$source){
        throw new \Exception("사이트 설정정보가 존재하지 않습니다");
    }else if($source['sc_list_method'] === 'GET' && !preg_match('~{{\s*page\s*}}~is', $source["sc_list_url"])){
        throw new \Exception("소스 [".$source["sc_name"]."]의 목록 URL에 {{page}}태그가 없습니다");
    }

    $lc->setSource($source);
    $lc->setPage($page);

    $result = $lc->execute();
    echo $jres->success($result);
    
    $source = null;
    unset($source);
    
}catch(\Exception $e){
    echo $jres->error($e->getMessage());
}

$lc = null;
unset($lc);

unset($result);

$jres = null;
unset($jres);