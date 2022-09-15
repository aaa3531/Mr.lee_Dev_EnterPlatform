<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;
use kr\c2\site as c2s;

$c2['title'] = '자동수집안내';
$mm = -1;
include(PATH_LAYOUT.'/default.head.php');

$bin_path = PHP_BINDIR.'/php';
$ini_path = php_ini_loaded_file();
$auto_path = realpath('.').'/auto.php';
?>

<div class="container" style="max-width: 500px; margin: 0 auto">
    <form id="frm_chpwd">
        <input type="hidden" name="act" value="change">
        <div class="form-group">
            <label for="password">새 비밀번호</label>
            <input type="password" name="password" id="password" class="form-control" data-c2val="required:true,label:'새 비밀번호',minlen:6">
        </div>
        <div class="form-group">
            <label for="password2">새 비밀번호 확인</label>
            <input type="password" name="password2" id="password2" class="form-control" data-c2val="required:true,label:'새 비밀번호 확인',equal:'password'">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">
                저장하기
            </button>
        </div>
    </form>
</div>

<script type="text/javascript">
<!--
$(document).ready(function() {
    $('#frm_chpwd').submit(function(event) {
        event.preventDefault();
        $('#frm_chpwd').c2Validate()
            .then(function() {
                $.ajax({
                    url: '?mod=password',
                    method: 'post',
                    dataType: 'json',
                    data: $('#frm_chpwd').serialize()
                })
                .done(function() {
                    $.confirm({title: '알림', content: '저장되었습니다', buttons: {
                        ok: function(){
                            $('#password, #password2').val('');
                        }
                    }});
                })
                .fail(function(error){
                    var msg = '저장실패';
                    if (error.responseJSON !== undefined) msg = error.responseJSON.message;
                    $.alert({title: '오류', content: msg});
                });
            });
    });
});
//-->
</script>

<?php
include(PATH_LAYOUT.'/default.tail.php');

