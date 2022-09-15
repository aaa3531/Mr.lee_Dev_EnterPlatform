<?php
if(!defined("__C2__")) exit("Access Denied");

define('__MAIN__', true);

include(PATH_LAYOUT.'/default.head.php');
?>
    <div class="container">
        <div class="jumbotron my-3">
            <h1 class="display-4">콩이 크롤러</h1>
            <p class="lead">외부 사이트의 컨텐츠를 자동으로 수집해 오는 솔루션입니다</p>
            <hr class="my-4">
            <p>http://cong2.kr</p>
            <a class="btn btn-primary btn-lg" href="http://cong2.kr" target="_blank" role="button">홈페이지로 가기</a>
        </div>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-danger">주의사항</h5>
                <p class="card-text">
                    크롤링&파싱기술은 프로그래밍 전반에 널리 사용되는 일반적 기술입니다.<br />
                    콩이파싱기는 웹사이트의 정보를 수집&가공&저장하는 소프트웨어입니다.<br />
                    당사가 제공하는 모든 제품은 불법적인 용도(성인,도박,저작권위반 등)로 사용할 수 없습니다.<br />
                    또한 원본사이트 소유자의 허락없는 스크래핑에 사용할 경우 저작권 침해가 될 수 있습니다.<br />
                    당사가 제공하는 제품을 불법적인 용도로 사용할 경우 모든 법적책임은 본인에게 있습니다.<br />
                    프로그램 사용 및 다운로드시 위 내용에 동의하는 것으로 간주합니다.
                </p>
            </div>
        </div>
    </div>
<?php
include(PATH_LAYOUT.'/default.tail.php');