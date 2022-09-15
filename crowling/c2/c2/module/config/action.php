<?php
if(!defined('__C2__')) exit('Access Denied');

use kr\c2 as c2;

$jres = new c2\util\JsonResult();

//$target = new c2\site\Target();
//$list = $target->member->gets($user_list);
//
//$user_list = array();
//for($i=0; $i<count($list); $i++) {
//    $user_list[] = $list[$i]->mb_id;
//}

$cf_cms_url = $input->post('cf_cms_url');
$cf_user_pwd = $input->post('cf_user_pwd');

$valid->check('required', 'cf_cms_url', $cf_cms_url, 'CMS 설치경로');
$valid->check('required', 'cf_user_pwd', $cf_user_pwd, '손님비밀번호');
if(!$valid->isSuccess()) {
    echo $jres->error($valid->getMessage());
}

$arr = array('cf_user_list', 'cf_replace_string', 'cf_imgexc_domain', 'cf_enctype_list');
foreach($arr as $key) {
    ${$key} = array_filter( array_map('trim', explode(PHP_EOL, $input->post($key))) );
}


$updir = PATH_DATA;
$updir_watermark = $updir.'/watermark';

if (!is_dir($updir_watermark))
    mkdir($updir_watermark, 0755, true);

$secur_str = '<'.'?php exit();?'.'>'.PHP_EOL;
$arr = array(
    'cf_cms_url' => $cf_cms_url,
    'cf_phpini_path' => php_ini_loaded_file(),
    'cf_user_list' => $cf_user_list,
    'cf_user_pwd' => trim($input->post('cf_user_pwd')),
    'cf_timeout' => trim($input->post('cf_timeout')),
    'cf_memory_limit' => trim($input->post('cf_memory_limit')),
    'cf_replace_string' => $cf_replace_string,
    'cf_imgexc_domain' => $cf_imgexc_domain,
    'cf_enctype_list' => $cf_enctype_list,
    'cf_imgur_url' => trim($input->post('cf_imgur_url')),
    'cf_imgur_id' => trim($input->post('cf_imgur_id')),
    'cf_torrent_exp' => trim($input->post('cf_torrent_exp')),
    'cf_torrent_author' => trim($input->post('cf_torrent_author')),
    'cf_wm_pos1' => trim($input->post('cf_wm_pos1')),
    'cf_wm_padding1' => trim($input->post('cf_wm_padding1')),
    'cf_wm_pos2' => trim($input->post('cf_wm_pos2')),
    'cf_wm_padding2' => trim($input->post('cf_wm_padding2')),
    'cf_img_maxw' => trim($input->post('cf_img_maxw')),
    'cf_img_maxh' => trim($input->post('cf_img_maxh')),
);

//워터마크 파일이 있으면
for($i=1; $i<=2; $i++){
    if(isset($_FILES['cf_wm_img'.$i]['size']) && $_FILES['cf_wm_img'.$i]['size'] > 0){

        $fu = new c2\file\FileUpload();
        $finfo = $fu->add(array(
                'mkdir' => true,
                'updir' => $updir_watermark,
                'field' => 'cf_wm_img'.$i,
                'naming' => c2\file\FileUpload::NAME_AUTO,
                'allow_ext' => 'jpg|jpeg|png|gif'
        ));
        try {
            $fu->upload();
            
            $arr['cf_wm_img'.$i] = $finfo['rname'];
            @unlink($updir_watermark.'/'.$c2cfg['cf_wm_img'.$i]);
        }catch(\Exception $e){
            echo $jres->error(($e->getMessage()));
            exit;
        }
    }
}

if(is_array($c2cfg)){
    $arr = array_merge($c2cfg, $arr);
}

$str = $secur_str.json_encode($arr, JSON_UNESCAPED_UNICODE);

touch($updir.'/config.php');
if(!c2\file\FileDir::writeFileContent($updir.'/config.php', $str, 'w')) {
    echo $jres->error('데이타 저장에 실패했습니다');
    exit;
}

echo $jres->success();
