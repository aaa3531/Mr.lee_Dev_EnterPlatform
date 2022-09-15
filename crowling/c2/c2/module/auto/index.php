<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;
use kr\c2\site as c2s;

$c2['title'] = '자동수집안내';
$mm = 3;
include(PATH_LAYOUT.'/default.head.php');

$bin_path = PHP_BINDIR.'/php';
$ini_path = php_ini_loaded_file();
$auto_path = realpath('.').'/auto.php';

$command = "30/* * * * * ".$bin_path." -c ".$ini_path." ".$auto_path." > /dev/null 2>&1";
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="card-title">실행명령어</div>
        </div>
        <div class="card-body">
            <p>
                <input type="text" class="form-control" value="<?php echo $command?>">
            </p>
            <?php echo c2s\help("
                ※ 30분마다 실행되는 명령어입니다<br>
                ※ 리눅스쉘에서 \"crontab -e\" 명령을 실행하여 위 구문을 붙여넣고 저장하면 됩니다<br>
                ※ crontab 편집은 구글에서 \"vi 편집기\" 를 검색하여 참조해 주세요<br>
                ※ 운영서버가 윈도우즈서버이면 이 명령이 유효하지 않습니다<br>
                ※ 윈도우즈서버는 스케쥴러를 이용해 주세요<br>
            ");?>
            
        </div>
    </div>
</div>

<?php
include(PATH_LAYOUT.'/default.tail.php');

