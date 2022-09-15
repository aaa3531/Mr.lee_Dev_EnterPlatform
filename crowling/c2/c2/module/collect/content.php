<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;
use kr\c2\site as c2s;

$cfg = c2s\get_config();


// Timeout 설정
if(!c2\isval($cfg["cf_timeout"])) $cfg["cf_timeout"] = 120;
set_time_limit($cfg["cf_timeout"]);


// Memory 최대 허용치 설정
if(!c2\isval($cfg["cf_memory_limit"])) $cfg["cf_memory_limit"] = "50";
ini_set("memory_limit", $cfg["cf_memory_limit"]."M");

//결과출력 컨테이너
$jres = new c2\util\JsonResult();


// 파라미터 정리
$target_url = urldecode($input->post('target_url'));
$sc_idx = $input->post('sc_idx');
$regdate = $input->post('regdate');
$board = $input->post('board');


// Validation
$valid->check('required', 'target_url', $target_url, 'URL');
$valid->check('required', 'sc_idx', $sc_idx, '소스번호');
$valid->check('required', 'board', $board, '게시판');

if(!$valid->isSuccess()) {
    echo $jres->error($valid->getMessage());
    exit;
}


// 소스 설정 불러오기
$source = $db->select("*")
    ->table("source")
    ->where("sc_idx=?", $sc_idx)
    ->query()->fetch(\PDO::FETCH_ASSOC);


// 유일키 검사
function callbackOverlap(){
    global $jres;
    echo $jres->error('이미 등록되어 있는 게시물입니다', null, 'duplicate');
    exit;
}

// 파일 다운로드 위치 구하기
$poster = c2s\Target::getInstance()->getPoster();
list($image_path, $image_url) = $poster->getDownloadImagePaths($board);
list($file_path, $file_url) = $poster->getDownloadFilePaths($board);

// ViewCrawler 처리
$vc = new c2s\ViewCrawler();

try{
    $poster = c2s\Target::getInstance()->getPoster();
    $poster->setSource($source);
    $poster->setBoard($board);
    
    $vc->setSource($source);
    $vc->setUrl($target_url);
    $vc->setDownloadImagePath($image_path, $image_url);
    $vc->setDownloadFilePath($file_path, $file_url);
    $vc->setEventListener(c2s\ViewCrawler::OVERLAPPED, "callbackOverlap");
    
    $data = $vc->execute();
    
    if(!$vc->isSuccess()){
        throw new \Exception("알 수 없는 이유로 수집에 실패하였습니다");
    }
            
    //날짜정리
    if(c2\isval($regdate) && preg_match("~[0-9]{4}\-[0-9]{2}\-[0-9]{2}\s[0-9]{2}\:[0-9]{2}\:[0-9]{2}~", $regdate) > 0){
        $regdate = $regdate;
    }
    
    if(!c2\isval($data["regdate"])){
        if(isset($regdate)){
            $data["regdate"] = $regdate;
        }else{
            $data["regdate"] = date('Y-m-d H:i:s');
        }
    }
    
    if(!c2\isval($data["subject"]) || !c2\isval($data["content"])){
        throw new \Exception("수집된 데이타가 없습니다");
    }
    
    //날짜 파싱값이 없다면 목록에서 던져준 값으로 세팅
    //if(!isset($data["wr_datetime"]) || trim($data["wr_datetime"])=="")
    //    $data["wr_datetime"] = $datetime;

    
    $poster->post($data);
    
}catch(Exception $e){
    if($e->getMessage()===c2s\ViewCrawler::SKIP_STR){
        echo $jres->error("수집제외 문자열이 포함되어 있습니다", null, "skipstr");
    }else{
        echo $jres->error($e->getMessage());
    }
    exit;
    
}finally {
    unset($source);
    unset($data);
    
    $vc=null;
    unset($vc);
    
    $poster=null;
    unset($poster);
}

//===========================================================================
// 등록 성공으로 출력
//===========================================================================
echo $jres->success();