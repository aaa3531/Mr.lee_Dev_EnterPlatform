<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;
use kr\c2\site as c2s;

$c2['title'] = '자동수집안내';

include(PATH_C2.'/head.php');

$e_s = new c2\html\Selectbox();
$e_s->add("utf-8", "UTF-8");
$e_s->add("euc-kr", "EUC-KR");
?>

<div class="regexptool">

    <h1 class="popup-title">정규표현식 테스트</h1>
    
    <form id="fexp" class="p-2">
        <div class="card mb-3">
            <div class="card-header">
                HTML 소스 가져오기
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="src">HTML 소스코드</label>
                    <textarea id="src" name="src" class="form-control"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="url">url</label>
                    <input type="text" id="url" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="encoding">엔코딩</label>
                    <select name="enctype" id="enctype" class="form-control">
                        <?php echo $e_s->getOption();?>
                    </select>
                </div>
                
                <div class="text-center">
                    <button type="button" id="btn_crawl" class="btn btn-dark">가져오기</button>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                정규식 테스트
            </div>
            <div class="card-body">
            
                <div class="form-group">
                    <label>옵션도우미</label>
                    <p class="form-text">
                        i : 대소문자 구분없이<br>
                        m : 소스문자열을 멀티라인으로 취급<br>
                        s : 소스문자열을 싱글라인으로 취급<br>
                        x : 패턴내에 공백문자 무시<br>
                    </p>
                </div>
                
                <div class="form-group">
                    <label for="exp">정규표현식</label>
                    <textarea id="exp" name="exp" class="form-control"></textarea>
                    <?php echo c2s\help('"~정규표현식~옵션" 형식으로 작성해주세요')?>
                </div>
                
                <div class="form-group">
                    <label for="result">결과</label>
                    <textarea id="result" class="form-control"></textarea>
                </div>
                
                <div class="text-center">
                    <button type="submit" id="btn_submit" class="btn btn-primary">결과확인</button>
                    <button type="button" id="btn_copy" class="btn btn-dark">정규식 복사</button>
                    <a href="#" onclick="window.close(); return false" class="btn btn-danger">닫기</a>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
<!--
function copy() { 
    var IE = (document.all) ? true : false;
    var data = $('#fexp').serialize();
    var exp_str = $('#exp').val();
    
    if (IE) {
        window.clipboardData.setData('Text', exp_str);
        alert('복사되었습니다.');
    } else {
        temp = prompt("Ctrl+C를 눌러 클립보드로 복사하세요", exp_str ); 
    }
} 

var __DEBUG__=true;

$(function(){
    
    $('#btn_copy').click(copy);
    
    $('#fexp').submit(function(){
        return false;
    });
    
    $('#btn_submit').click(function(){
        $('#result').text("Processing...");
        var data = $('#fexp').serialize();
        $.ajax({
            url: '?mod=regextool&act=exp',
            method: 'post',
            data: data
        })
        .done(function(data){
            if(data.indexOf('Array') > -1 || __DEBUG__){
                $('#result').text(data);
            }else{
                $('#result').text('정규식에 오류가 있습니다');
            }
        })
        .fail(function(jqXHR, textStatus){
            var msg = jqXHR.responseText;
            if(msg == ''){
                msg = '데이타가 수신되지 않았습니다';
            }
            $('#result').text("오류가 발생했습니다 - " + textStatus + '(' + msg + ')');
        });
        return false;
    });
    
    $('#btn_crawl').click(function(){
        $('#src').text("");
        var url = $('#url').val().trim();
        var enctype = $('#enctype').val();
        
        if(url==''){
            alert('url을 입력해 주세요');
            return;
        }
        var data = 'url=' + encodeURIComponent(url) + '&enctype=' + enctype;
        
        $('#src').text("가져오는중...");
        $.ajax({
            url: '?mod=regextool&act=crawl',
            method: 'post',
            data: data
        })
        .done(function(result){
            $('#src').val(result);
        })
        .fail(function(jqXHR, textStatus){
            $('#src').text("오류가 발생했습니다 - " + jqXHR.responseText);
        });
    });
});
//-->
</script>

<?php
include(PATH_C2.'/tail.php');