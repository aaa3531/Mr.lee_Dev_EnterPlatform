<?php
use kr\c2 as c2;
use kr\c2\site as c2s;

define('_C2_', true);
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

include_once(PATH_C2.'/define.php');
include_once(PATH_C2.'/lib/function/c2.func.php');
include_once(PATH_C2.'/lib/function/site.func.php');

$cms_name = c2s\get_cms_name();
?>
<!doctype html>
<html>
<head>
	<title>콩이 크롤러 설치하기</title>
	<script src="../js/jquery-1.12.0.min.js"></script> 
	<link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/default.css" />
	<script src="//code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/jquery.c2validator.js"></script>
</head>
<body>
<div class="container" style="margin-top:50px">
    <h2 class="text-center">콩이 크롤러 Install</h2>
	<form id="finstall" action="install_update.php" method="post" class="mb-5">
		<div class="card mb-4">
			<div class="card-header">크롤러 DataBase</div>
			<div class="card-body">
				<div class="form-group">
					<label for="base_host">HostName</label>
					<input type="text" name="base_host" id="base_host" class="form-control" value="localhost" data-c2val="label:'크롤러 HostName', required:true">
				</div>
				<div class="form-group">
					<label for="base_username">User ID</label>
					<input type="text" name="base_username" id="base_username" class="form-control" data-c2val="label:'크롤러 User ID', required:true">
				</div>
				<div class="form-group">
					<label for="base_password">Password</label>
					<input type="text" name="base_password" id="base_password" class="form-control" data-c2val="label:'크롤러 Password', required:true">
				</div>
				<div class="form-group">
					<label for="base_dbname">DataBase Name</label>
					<input type="text" name="base_dbname" id="base_dbname" class="form-control" data-c2val="label:'크롤러 DataBase Name', required:true">
				</div>
                <div class="form-group">
                    <label for="base_prefix">Table Prefix</label>
                    <input type="text" name="base_prefix" id="base_prefix" class="form-control" value="c2_" data-c2val="label:'크롤러 Table Prefix', required:true">
                </div>
                <div class="form-group">
                    <label for="base_port">Port</label>
                    <input type="text" name="base_port" id="base_port" class="form-control" value="3306" data-c2val="label:'크롤러 DataBase Port', required:true">
                </div>
			</div>
		</div>
        
        <div class="card mb-4">
            <div class="card-header"><?php echo $cms_name?> DataBase</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="target_host">HostName</label>
                    <input type="text" name="target_host" id="target_host" class="form-control" value="localhost" data-c2val="label:'크롤러 HostName', required:true">
                </div>
                <div class="form-group">
                    <label for="target_username">User ID</label>
                    <input type="text" name="target_username" id="target_username" class="form-control" data-c2val="label:'크롤러 User ID', required:true">
                </div>
                <div class="form-group">
                    <label for="target_password">Password</label>
                    <input type="text" name="target_password" id="target_password" class="form-control" data-c2val="label:'크롤러 Password', required:true">
                </div>
                <div class="form-group">
                    <label for="target_dbname">DataBase Name</label>
                    <input type="text" name="target_dbname" id="target_dbname" class="form-control" data-c2val="label:'크롤러 DataBase Name', required:true">
                </div>
                <div class="form-group">
                    <label for="target_prefix">Table Prefix</label>
                    <input type="text" name="target_prefix" id="target_prefix" class="form-control" value="g5_" data-c2val="label:'크롤러 Table Prefix', required:true">
                </div>
                <div class="form-group">
                    <label for="target_port">Port</label>
                    <input type="text" name="target_port" id="target_port" class="form-control" value="3306" data-c2val="label:'크롤러 DataBase Port', required:true">
                </div>
            </div>
        </div>
		
		<div class="card mb-4">
			<div class="card-header">관리자 비밀번호</div>
			<div class="card-body">
				<div class="form-group">
					<label for="adm_pwd">Password</label>
					<input type="text" name="password" id="password" class="form-control" data-c2val="label:'관리자 비밀번호', required:true">
				</div>				
			</div>
		</div>
		
        <div class="text-center">
		    <button type="submit" class="btn btn-primary btn-lg">설치하기</button>
        </div>
	</form>
</div>

<script type="text/javascript">
<!--
$(document).ready(function(){
    $('#finstall').submit(function(){
        return $(this).c2Validate(true);
    });
});
//-->
</script>

</body>
</html>