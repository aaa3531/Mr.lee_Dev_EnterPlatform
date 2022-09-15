<?php
function convertAnsi($str) {
    return iconv("UTF-8", "EUC-KR", $str);
}

function replace_unicode_escape_sequence($match) {
    return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
}

function unicode_decode($str) {
    return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $str);
}

// m2b.co.kr
if ($this->source['sc_idx'] == '4') {
    $wr_content = str_replace('\"', '"', $wr_content);
    $arr = json_decode($wr_content, JSON_UNESCAPED_UNICODE);
    
    $options = array();
    foreach($arr as $item) {
        $options[] = unicode_decode($item['option_name']).':'.unicode_decode($item['option_value']);
    }
    $str = @implode('|', $options);
    $wr_subject = convertAnsi(str_replace(",", "", $wr_subject));
    $wr_content = convertAnsi(str_replace(",", "", $str));
    $wr_caname = convertAnsi(str_replace(",", "", $wr_caname));
    $wr_1 = convertAnsi(str_replace(",", "", $wr_1));
    $wr_2 = convertAnsi(str_replace(",", "", $wr_2));
    $wr_3 = convertAnsi(str_replace(",", "", $wr_3));
    $wr_4 = convertAnsi(str_replace(",", "", $wr_4));
        
    $str = $wr_subject.','.$wr_caname.','.$wr_content.','.$wr_1.','.$wr_2.','.$wr_3.','.$wr_4.PHP_EOL;
    
    $dir = PATH_DATA.'/collect';
    $filename = 'm2b_'.$wr_caname.'.csv';
    if(!is_dir($dir)){
        mkdir($dir, true);
    }
    $fp = fopen($dir.'/'.$filename, 'a+');
    fwrite($fp, $str);
    fclose($fp);
    return;
}