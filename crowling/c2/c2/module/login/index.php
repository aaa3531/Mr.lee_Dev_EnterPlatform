<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;
use kr\c2\site as c2s;

if (c2\isval($_SESSION['login'])) {
    c2\go(URL_C2);
    exit;
}

$c2['title'] = '로그인';
$mm = -1;
include(PATH_C2.'/head.php');

$base_url = $router->getURL();
?>

    <div class="container p-3 mt-5" style="max-width: 300px;">
        
        <form name="flogin" id="flogin">
            <input type="hidden" name="act" value="login">
            
            <div class="form-group">
                <label for="password">비밀번호를 입력해주세요</label>
                <input type="password" name="password" class="form-control" data-c2val="required:true,label:'비밀번호'">
            </div>
                
            <div class="text-center">
                <button type="submit" class="btn btn-primary" accesskey='s'>로그인</button>
            </div>
            
        </form>
    </div>
    
    <script type="text/javascript">
    <!--
    function frmCheck(evt){
        evt.preventDefault();
        
        $('#flogin').c2Validate()
            .then(function() {
                $.ajax({
                    url: '?mod=login',
                    method: 'post',
                    dataType: 'json',
                    data: $('#flogin').serialize(),
                })
                .done(function() {
                    location.href = './';
                })
                .fail(function(error) {
                    console.log(error);
                    var msg = '로그인실패';
                    if (error.responseJSON !== undefined) msg = error.responseJSON.message;
                    $.alert({title: '오류', content: msg});
                });
            })
            .catch(function(e) {
                $.alert({title: '오류', content: e.message});
            })
    }
    
    $(document).ready(function() {
        $('#flogin').submit(frmCheck);
    })
    //-->
    </script>

<?php
include(PATH_C2.'/tail.php');