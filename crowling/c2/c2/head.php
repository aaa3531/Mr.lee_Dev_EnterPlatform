<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;

$host = "http://".$_SERVER["HTTP_HOST"];
?><!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo c2\varset($description)?>">
<meta name="keywords" content="<?php echo c2\varset($keywords)?>">
<meta property="og:locale" content="ko_KR" />
<meta property="og:type" content="website" />
<meta property="og:title" content="<?php echo c2\binstr($title, c2\varset($dminfo["dm_sitename"]))?>"/>
<meta property="og:description" content="<?php echo c2\binstr($description, c2\varset($dminfo["dm_sitename"]))?>"/>
<meta property="og:url" content="<?php echo $host?>" />
<meta property="og:site_name" content="<?php echo c2\varset($dminfo["dm_sitename"])?>" />
<meta name="author" content="<?php echo c2\varset($dminfo["dm_sitename"])?>" />
<meta name="publisher" content="<?php echo c2\varset($dminfo["dm_sitename"])?>" />
<!-- <meta name="classification" content="<?php echo c2\varset($dminfo["dm_sitename"])?>" /> -->

<meta name="classification" content="<?php echo c2\binstr($title, c2\varset($dminfo["dm_sitename"]))?>">
<meta name="Robots" content="ALL" />
<meta name="Robots" content="index,follow" />

<?php
/*
<meta http-equiv="imagetoolbar" content="no">
<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1">
<meta name="title" content="{c2\binstr($title, c2\varset($dminfo["dm_sitename"]))}" />
*/
?>

<link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?php echo URL_CSS?>/default.css?<?php echo mt_rand(1, 9999);?>" />
<!--<link rel="stylesheet" type="text/css" href="<?php echo URL_CSS?>/colorset.css" />-->
<link rel="stylesheet" type="text/css" href="<?php echo URL_JS?>/jquery-confirm/jquery-confirm.min.css" />
<script src="//code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo URL_JS?>/default.js"></script>
<script type="text/javascript" src="<?php echo URL_JS?>/jquery.c2validator.js"></script>
<script type="text/javascript" src="<?php echo URL_JS?>/jquery-confirm/jquery-confirm.min.js"></script>
<script type="text/javascript">
<!--
var path_c2 = '<?php echo PATH_C2?>';
var url_c2 = '<?php echo URL_C2?>';
//-->
</script>
{:header:}
<title><?php echo c2\binstr($c2['title'], $c2['title'].' | '.SITE_TITLE, SITE_TITLE)?></title>
</head>
<body>
<?php
unset($css);
unset($script);