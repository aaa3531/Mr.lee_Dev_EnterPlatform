<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;
use kr\c2\site as c2s;

$jres = new c2\util\JsonResult();

$act = $input->request('act');

$password = $input->post('password');
$password2 = $input->post('password2');

$valid->check('required|minlen:6', 'password', $password, '새 비밀번호');
$valid->check('required|equal', 'password2', $password2, '새 비밀번호 확인', 'password', $password, '새 비밀번호');
if (!$valid->isSuccess()) {
    echo $jres->error($valid->getMessage());
    exit;
}

$data = array('password' => password_hash($password, PASSWORD_DEFAULT));


try {
    $updir = PATH_DATA;
    if(!is_dir($updir)) mkdir($updir, 0755, true);

    touch($updir.'/password.php');
    $fdata = new c2\file\FileData();
    $fdata->setFilePath($updir.'/password.php');
    $fdata->saveData($data);
    
    echo $jres->success();
    
} catch(\Exception $e) {
    echo $jres->error('데이타 저장에 실패했습니다');
    exit;
}
