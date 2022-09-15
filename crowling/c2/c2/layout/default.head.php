<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;

$htmlheader = c2\HtmlHeader::getInstance();
$htmlheader->addCSS(URL_LAYOUT.'/css/default.layout.css');

include_once(PATH_C2."/head.php");
?>


<header>
    <div id="top" class="pt-5">
        <div class="container">
            <div class="site-logo">
                <h2><a href="<?php echo URL_C2?>">콩이 크롤러</a></h2>
            </div>
        </div>
    </div>
    <nav id="gnb">
        <div class="container">
            <ul>
                <li><a href="<?php echo URL_C2?>/?mod=config"<?php echo c2\varset($mm)==0 ? ' class="active"' : '';?>>기본설정</a></li>
                <li><a href="<?php echo URL_C2?>/?mod=source"<?php echo c2\varset($mm)==1 ? ' class="active"' : '';?>>소스관리</a></li>
                <li><a href="<?php echo URL_C2?>/?mod=collect"<?php echo c2\varset($mm)==2 ? ' class="active"' : '';?>>수집하기</a></li>
                <li><a href="<?php echo URL_C2?>/?mod=auto"<?php echo c2\varset($mm)==3 ? ' class="active"' : '';?>>자동수집안내</a></li>
            </ul>
            <div class="btn-wrap">
                <a href="<?php echo URL_C2?>/?mod=password" class="btn btn-sm btn-dark btn-chpwd">비밀번호변경</a>
                <a href="<?php echo URL_C2?>/?mod=login&act=logout" class="btn btn-sm btn-dark btn-logout">로그아웃</a>
            </div>
        </div>
    </nav>
</header>

<?php if(!defined('__MAIN__')) {?>
<div id="subject-wrap">
    <div class="container">
        <h4><?php echo $c2['title']?></h4>
    </div>
</div>
<?php }?>