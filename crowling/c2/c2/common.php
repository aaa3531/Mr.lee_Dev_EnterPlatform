<?php
use kr\c2 as c2;
use kr\c2\site as c2s;

//===========================================================================
// 초기화
//===========================================================================
include_once('define.php');

switch(ENVIRONMENT){
case 'development':
    ini_set('display_errors', 1);
	error_reporting(E_ALL);
	break;
	
case 'release':
default:
	error_reporting(0);
}

//===========================================================================
// 설치확인
//===========================================================================
include('./install/functions.php');

if (!installCheckC2() || !installCheckIonCube()) {
echo <<< HEREDOC
<script type="text/javascript">
    alert('설치가 완료되지 않았습니다');
    location.replace('./install');
</script>
HEREDOC;
    exit;
}

//===========================================================================
// 필수 모듈
//===========================================================================
include_once(PATH_LIB."/function/c2.func.php");

//이사이트 전용
include_once(PATH_LIB."/function/site.func.php");

include_once(PATH_VENDOR."/autoload.php");

//===========================================================================
// 벤치마크 시작
//===========================================================================
c2\util\Benchmark::init();

//===========================================================================
// Set ErrorHandler
//===========================================================================
//Error Handler Settting
set_error_handler(array('kr\c2\Exception', 'execute'));

//Fatal Error Handler Setting
register_shutdown_function(array('kr\c2\Exception', 'fatalErrorHandler'));

//===========================================================================
//db연결
//===========================================================================
/* @var BDB */
$db = c2\DB::getInstance();

//===========================================================================
//BInput 클래스 초기화
//===========================================================================
/* @var BInput */
$input = c2\get_input();


//===========================================================================
// BValidator 객체
//===========================================================================
/* @var BValidator */
$valid = c2\Validator::getInstance();
$valid->setErrorProcessType(c2\Validator::ERRPROC_NONE);

//===========================================================================
//Session start
//===========================================================================
/* @var BSession */
$session = c2\Session::getInstance();

if($session->start() == FALSE){
	c2\show_error('session_error');
}


//===========================================================================
// Html Header
//===========================================================================
/* @var BHtmlHeader */

$header = c2\HtmlHeader::getInstance();


//===========================================================================
// 설정 불러오기
//===========================================================================
//$config = c2\get_config();
//글로벌 변수들
$c2 = array();

//기본설정
$c2cfg = c2\site\get_config();

//===========================================================================
// 회원정보
//===========================================================================
$member = array();

$ss_mb_id = c2\get_session('mb_id');

if(c2\isval($ss_mb_id)){
    
    $member = bts\get_member($ss_mb_id);
    
    if(is_array($member)) $is_member = true;
    
}

unset($ss_mb_id);

ob_start();