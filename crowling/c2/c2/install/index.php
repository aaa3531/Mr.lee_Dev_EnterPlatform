<?php
use kr\c2 as c2;
use kr\c2\site as c2s;

define('_C2_', true);
define('PATH_C2', '..');
define('URL_C2', '..');

include('./functions.php');

if(installCheckIonCube() && installCheckC2()) {
    echo <<< HEREDOC
<script type="text/javascript">
    alert('이미 설치되어 있습니다');
    location.replace('../');
</script>
HEREDOC;
    exit;
}
?>

<!doctype html>
<html>
<head>
    <title>콩이 크롤러 설치하기</title>
    <script src="../js/jquery-1.12.0.min.js"></script> 
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/default.css" />
    <script src="//code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="jumbotron mt-5">
            <h1 class="display-4">콩이크롤러 설치하기</h1>
            <p class="lead">콩이크롤러를 구입해 주셔서 감사합니다.</p>
            <hr class="my-4">
            <p>아래 순서대로 설치를 진행해 주세요</p>
            <a class="btn btn-primary btn-lg" href="./loader-wizard.php" target="_blank" role="button">1. 1onCube Loader 설치하기</a>
            <a class="btn btn-primary btn-lg" href="./install_form.php" target="_blank" role="button">2. 콩이크롤러 설치하기</a>
        </div>
    </div>
</body>
</html>
