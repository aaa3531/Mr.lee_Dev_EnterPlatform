<?php if(!defined('__C2__')) exit;
http_response_code(400);
?>
<?php
if($err_no){
	echo 'Error Code : ['.$err_no.'] '.$err_label.'<br>'.PHP_EOL;
}

if($err_file){
	echo 'File : '.$err_file.'<br>'.PHP_EOL;
}

if($err_line){
	echo 'Line : '.$err_line.'<br>'.PHP_EOL;
}

foreach($ext_msg as $key=>$value){
	echo $key.' : ';
	if(is_array($value)){
		echo '<pre style="text-align:left">'.PHP_EOL;
		print_r($value);
		echo '</pre>'.PHP_EOL;
	}else if(is_object($value)){
		echo get_class($value).'<br>'.PHP_EOL;
	}else{
		echo $value.'<br>'.PHP_EOL;;
	}
}

echo 'Description : '.$err_msg.'<br>'.PHP_EOL;

echo '<br><br>'.PHP_EOL.PHP_EOL;


//Fatal Error 일경우 하단코드 처리 안함
if($err_no == E_ERROR) exit();

$debug = debug_backtrace();


echo '<h3>Back Trace File List</h3>'.PHP_EOL;


//깊이가 1이면 인덱스 0부터
//$sidx = count($debug) > 1 ? 1 : 0;


$is_find = FALSE;
$i = 0;
$depth = count($debug);
foreach($debug as $item){
	
	if($is_find==FALSE){
		
		if($err_no!=E_ERROR && isset($item['file']) && $item['file']!=$err_file && isset($item['line']) && $item['line']!=$err_line){
			$depth--;
			continue;
		}
		$is_find = TRUE;
	}
	
	echo 'Depth : '.$depth.'<br>'.PHP_EOL;

	if(isset($item['file'])){
		echo 'File : '.$item['file'].' (Line : '.$item['line'].')<BR>'.PHP_EOL;
	}
	
	if(isset($item['function'])){
		echo 'Function : '.$item['function'].'<BR>'.PHP_EOL;
	}
	
	if(isset($item['class'])){
		if($item['class']!='') echo 'Class : '.$item['class'].'<BR>'.PHP_EOL;
	}
	
	echo '<br><br>'.PHP_EOL.PHP_EOL;
	
	$depth--;
}
