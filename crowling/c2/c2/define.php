<?php
if (!defined('_C2_')) define("_C2_", true);

error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED);

//ini_set("display_errors", 1);
//ini_set("display_errors", true);

//===========================================================================
// 에러코드 define (버전별로 없는게 있어서..)
//===========================================================================
if(!defined("E_STRICT")) define("E_STRICT", 2048);
if(!defined("E_RECOVERABLE_ERROR ")) define("E_RECOVERABLE_ERROR ", 4096);
if(!defined("E_DEPRECATED")) define("E_DEPRECATED", 8192);
if(!defined("E_USER_DEPRECATED")) define("E_USER_DEPRECATED ", 16384);
if(!defined("E_ALL")) define("E_ALL", 32767);
if(!defined("E_FATAL")) define("E_FATAL", E_ERROR | E_USER_ERROR | E_PARSE | E_CORE_ERROR | E_COMPILE_ERROR | E_RECOVERABLE_ERROR);

//===========================================================================
// 세션설정
//===========================================================================
// 2/100 (2%) 확률로 세션가비지 작동 (가비지 컬렉션이 cpu를 많이 먹는다)
define("SESS_GC_PROBABILITY", 2);

// 세션 캐쉬 만료시간 (분) : 만료되면 새로운 파일을 만듬
define("SESS_CACHE_EXPIRE", 3600);

// 사용되지 않는 것으로 보이는 세션 데이터를 삭제한다. (초)
// 기본 설정 시간인 1440초 동안 아무런 요청이 없을때 자동으로 세션 데이터를 삭제하도록 되어 있다.
define("SESS_GC_MAXLIFETIME", 3600);

// 쿠키 저장경로
define("COOK_PATH", "/");

// 쿠키 적용 도메인
define("COOK_DOMAIN", "");

// 쿠키 유지시간 (0은 브라우저 켜져있는동안)
define("COOK_LIFETIME", 0);

define("COOK_FORCE_SSL", false);


//===========================================================================
// PCong 임의 상수
//===========================================================================
define("EXT", "php");
define("DS", DIRECTORY_SEPARATOR);

define("ENVIRONMENT", "development");
//define("ENVIRONMENT", "production");

//define("URL_C2", $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["HTTP_HOST"]);
//define("URL_C2", "http://".$_SERVER["HTTP_HOST"]);

define("DEFAULT_DOMAIN", "");

if(!isset($_SERVER["HTTP_HOST"]) || trim($_SERVER["HTTP_HOST"])=='')
    $_SERVER["HTTP_HOST"] = DEFAULT_DOMAIN;

if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"]=="on") $scheme = "https";
else $scheme = "http";

if (!defined('URL_C2'))
    define("URL_C2", $scheme."://".rtrim($_SERVER["HTTP_HOST"]).dirname($_SERVER['PHP_SELF']));

define("URL_CSS", URL_C2."/css");
define("URL_JS", URL_C2."/js");
define("URL_LIB", URL_C2."/lib");
define("URL_INC", URL_C2."/inc");
define("URL_DATA", URL_C2."/data");
define("URL_ETC", URL_C2."/etc");
define("URL_MOD", URL_C2."/module");
define("URL_LAYOUT", URL_C2."/layout");
define("URL_PLUGIN", URL_C2."/plugin");

if (!defined('PATH_C2'))
    define("PATH_C2", realpath("./"));

define("PATH_VENDOR", PATH_C2."/vendor");
define("PATH_CSS", PATH_C2."/css");
define("PATH_JS", PATH_C2."/js");
define("PATH_LIB", PATH_C2."/lib");
define("PATH_INC", PATH_C2."/inc");
define("PATH_DATA", PATH_C2."/data");
define("PATH_ETC", PATH_C2."/etc");
define("PATH_MOD", PATH_C2."/module");
define("PATH_LAYOUT", PATH_C2."/layout");
define("PATH_PLUGIN", PATH_C2."/plugin");

//===========================================================================
// 현재시간: 구할때마다 달라지는것 방지
//===========================================================================
define("DATE", date("Y-m-d"));
define("DATETIME", date("Y-m-d H:i:s"));

//===========================================================================
// 사이트이름
//===========================================================================
define("SITE_TITLE", "C2 크롤러");


//===========================================================================
// 타겟 솔루션
//===========================================================================
// 그누보드
define("TARGET_TYPE", "G5");

// 솔루션별 define
$target_define = PATH_INC.'/'.strtolower(TARGET_TYPE).'_define.php';
if (file_exists($target_define)) {
    include(PATH_INC.'/'.strtolower(TARGET_TYPE).'_define.php');
}