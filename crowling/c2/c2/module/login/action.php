<?php
if(!defined('__C2__')) exit('Access Denied');

use kr\c2 as c2;

$jres = new c2\util\JsonResult();

$act = $input->request('act');

if ($act == 'login') {
    $password = $input->post('password');

    $valid->check('required', 'password', $password, '비밀번호');
    if(!$valid->isSuccess()){
        echo $jres->error($valid->getMessage());
        exit;
    }

    $fdata = new c2\file\FileData();
    $fdata->setFilePath(PATH_DATA.'/password.php');
    $data = $fdata->readData();

    if (!password_verify($password, $data['password'])) {
        echo $jres->error('비밀번호가 틀렸습니다');
        exit;
    }
    $_SESSION['login'] = true;
    echo $jres->success();
    exit;
    
} else if ($act == 'logout') {
    unset($_SESSION['login']);
    c2\go(URL_C2);
}