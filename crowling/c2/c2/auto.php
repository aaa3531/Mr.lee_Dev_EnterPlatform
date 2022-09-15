<?php
define('__C2__', true);

use kr\c2 as c2;
use kr\c2\site as c2s;

include_once("common.php");

//-------------------------------
// 사용자 설정부분
//-------------------------------
/*
* 첫페이지만 수집할지 여부
* false 일 경우 소스관리에서 입력한 페이지 범위로 가져옵니다
*
* << 주의 >>
* false 일 경우 상당한 시간이 소요되며
* 크론탭이 중복해서 실행될경우 문제가 발생할 수 있습니다
* 이때는 크론탭으로 실행하지 마시고 쉘에서 직접 실행해 주세요
*/
$only_first_page = true;


// Timeout 무제한
set_time_limit(0);
// 메모리 사용량 무제한
ini_set("memory_limit", -1);


//-------------------------------
// 수정금지 부분
//-------------------------------
echo PHP_EOL.PHP_EOL;

c2\show_memory(true);

$request = c2\net\Request::getInstance();
$request->setCookieFile(PATH_DATA."/cookie_auto.txt");

$auto = new c2s\AutoCrawler();
$auto->setOnlyFirstPage($only_first_page);

$auto->execute();

echo PHP_EOL.PHP_EOL;

echo <<<HEREDOC
┌───────────────────────────────────────────┐
│                                           │
│              ★ C2 Crawler ★               │
│                JOB Finish!                │
│                                           │
└───────────────────────────────────────────┘
HEREDOC;
echo PHP_EOL.PHP_EOL;
echo '<메모리 사용량>'.PHP_EOL;
c2\show_memory();
