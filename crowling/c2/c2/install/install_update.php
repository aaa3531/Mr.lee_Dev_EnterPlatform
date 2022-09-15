<?php
ini_set('display_errors', true);
define('_C2_', true);

use kr\c2 as c2;

define('PATH_C2', '..');
define('URL_C2', '..');

include('./functions.php');

if(!installCheckIonCube()) {
    echo <<< HEREDOC
<script>
    alert('이온큐브로더를 먼저 설치해 주세요');
    location.replace('./index.php');
</script>
HEREDOC;
    exit;
}

if(installCheckC2()) {
    echo <<< HEREDOC
<script>
    alert('크롤러가 이미 설치되어 있습니다');
    location.replace('./index.php');
</script>
HEREDOC;
    exit;
}


include_once('../lib/function/c2.func.php');
include_once('../lib/classes/DB.php');
include_once('../lib/classes/file/FileDir.php');
include_once('../lib/classes/file/FileData.php');

$dir = '../data';
$db_filepath = $dir.'/database.php';
$pwd_filepath = $dir.'/password.php';

if (file_exists($db_filepath) && file_exists($pwd_filepath)) {
    c2\go('../');
    exit;
}

if(!is_dir($dir)) {
    c2\alert_back('c2/ 디렉터리 하위에 data 디렉터리를 만들고 퍼미션을 707로 지정해주세요');
    exit;
}

if (!is_writable($dir)) {
    c2\alert_back('data 디렉터리의 퍼미션을 707로 지정해주세요');
    exit;
}

//===========================================================================
// database.php 파일 생성
//===========================================================================
foreach($_POST as $key => $val) {
    $_POST[$key] = trim($_POST[$key]);
}

$database = array();
$database['base']['dbms'] = "mysql";
$database['base']['host'] = $_POST["base_host"];
$database['base']['dbname'] = $_POST["base_dbname"];
$database['base']['port'] = $_POST["base_port"];
$database['base']['charset'] = "utf8";
$database['base']['username'] = $_POST["base_username"];
$database['base']['password'] = $_POST["base_password"];
$database['base']['prefix'] = $_POST["base_prefix"];

$database['target']['dbms'] = "mysql";
$database['target']['host'] = $_POST["target_host"];
$database['target']['dbname'] = $_POST["target_dbname"];
$database['target']['port'] = $_POST["target_port"];
$database['target']['charset'] = "utf8";
$database['target']['username'] = $_POST["target_username"];
$database['target']['password'] = $_POST["target_password"];
$database['target']['prefix'] = $_POST["target_prefix"];

foreach($database as $type => $db) {
    try{
        $conn[$type] = c2\DB::getInstance($type, $db);
        if(!$conn[$type]) new \Exception();
    }catch(Exception $e){
        c2\alert_back('데이터베이스 접속 실패');
    }
}

$db_tpl = file_get_contents('./database.tpl.php');

foreach($database as $type => $db) {
    foreach($db as $key => $val) {
        $db_tpl = str_replace('{{'.$type.'_'.$key.'}}', $val, $db_tpl);
    }
}

try {
    $fp = fopen($db_filepath, 'w');
    fwrite($fp, $db_tpl);
    fclose($fp);
} catch(\Exception $e) {
    @unlink($db_filepath);
    c2\alert_back($e->getMessage());
}


//===========================================================================
// 테이블 생성
//===========================================================================
$file = file('./sql.php');
unset($file[0]);
$sql = @implode('', $file);
try {
    $conn['base']->query($sql);
} catch (\Exception $e) {
    c2\alert_back($e->getMessage());
}


//===========================================================================
// 관리자 비밀번호 저장
//===========================================================================
$data = array(
    'password' => password_hash($_POST["password"], PASSWORD_DEFAULT)
);

try {
    $fdata = new c2\file\FileData();
    $fdata->setFilePath($pwd_filepath);
    $fdata->saveData($data);
} catch(\Exception $e) {
    @unlink($db_filepath);
    @unlink($pwd_filepath);
    c2\alert_back($e->getMessage());
}

c2\go('../');