<?php
// IonCube Loader 설치되어 있는지 체크
function installCheckIonCube() {
    
    $exts = get_loaded_extensions();
    
    foreach ($exts as $number => $ext_name) {
        if (preg_match('~ioncube~is', $ext_name)) {
            return true;
        }
    }
    
    return false;
}


// 크롤러 설치되어 있는지 체크
function installCheckC2() {
    // DB와 패스워드 파일이 있는지 체크    
    $db_filepath = PATH_C2.'/data/database.php';
    $pwd_filepath = PATH_C2.'/data/password.php';
    $is_install = false;
    if (file_exists($db_filepath) && file_exists($pwd_filepath)) {
        return true;
    }
    
    return false;
}