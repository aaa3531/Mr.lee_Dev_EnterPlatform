<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;
use kr\c2\site as c2s;

$jres = new c2\util\JsonResult();

$sc_idx = $input->post('sc_idx');

if(!c2\isval($sc_idx)) {
    echo $jres->error('데이터 전달 에러');
    exit;
}

$row = $db->select("*")
    ->table("source")
    ->where("sc_idx=?", $sc_idx)
    ->query()->fetch(\PDO::FETCH_ASSOC);
    
$login = new c2s\LoginCrawler();

try{
    $login->setSource($row);

    if (!$login->isUseLogin()) {
        echo $jres->success("login_not_use");
        exit;
    }
    $login->execute();
}catch(\Exception $e){
    echo $jres->error($e->getMessage());
    exit;
}

echo $jres->success("login_success");