<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;
use kr\c2\site as c2s;

$jres = new c2\util\JsonResult();

$act = $input->request('act');
$src = $input->post('src', false);
$exp = $input->post('exp', false);

if($act == 'crawl'){
    
    $url = $input->post('url');
    $enctype = $input->post('enctype');
    
    try{
        $request = new c2\net\Request();
        $request->setCookieFile(c2s\get_cookie_path());
        $request->setContainHeader(false);
        $request->setTimeout(10);
        $request->setConnectTimeout(10);
        $request->setUrl($url);
        $temp = parse_url($url);
        $request->setRefer($temp["scheme"]."://".$temp["host"]);
        $request->setCipher(c2s\get_cipher($temp["host"]));
        $request->setEventListener(c2\net\Request::FIND_CIPHER, "kr\c2\site\find_record_cipher");
        
        $result = $request->request('utf-8', $enctype);
    }catch(Exception $e){
        echo $e->getMessage();
        exit;
    }
    
    if(!$result->success){
        echo '<pre style="text-align:left">';
        print_r($result);
        echo '</pre>';
        
    }else{
        echo $result->data;
    }
    exit;

}else if($act == 'exp' && c2\isval($src) && c2\isval($exp)){

    $rexp = new c2s\RegexpParser();
    $rexp->setDoc($src);
    $rexp->addPattern($exp);
    $result = $rexp->parse();
    print_r($result);
    exit;
}
