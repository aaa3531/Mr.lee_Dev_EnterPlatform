<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;
use kr\c2\site as c2s;

$sc_idx = $input->get('sc_idx');

if(!c2\isval($sc_idx)){
    c2\alert_close("필수 입력값이 전달되지 않았습니다");
}


$row = $db->select("*")
    ->table("source")
    ->where("sc_idx=?", $sc_idx)
    ->query()
    ->fetch(\PDO::FETCH_ASSOC);

$c2['title'] = '복사하기';

include(PATH_C2.'/head.php');
?>
    <div class="copy-wrap">
        <h1 class="popup-title"><?php echo $row["sc_name"]?> 복사하기</h1>
        <form id="frm_copy" class="p-5">
            <input type="hidden" name="act" value="copy">
            <input type="hidden" name="sc_idx" value="<?php echo $_GET["sc_idx"]?>">
            <div class="form-group row">
                <label for="sc_name" class="col-3 col-form-label">소스이름(*)</label>
                <div class="col-9">
                    <input type="text" name="sc_name" id="sc_name" required="required" class="form-control form-control-sm">
                </div>
            </div>
            <div class="form-group row">
                <label for="sc_list_url" class="col-3 col-form-label">목록 페이지 URL(*)</label>
                <div class="col-9">
                    <input type="text" name="st_list_url" id="st_list_url" class="form-control form-control-sm">
                    <?php echo c2s\help("게시판목록 페이지의 전체 URL을 입력해 주세요.<br>URL중 페이지번호에 해당하는 부분(예: page=1)은 page={{page}} 형식으로 변경해주세요.")?>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-sm btn-primary">복사하기</button>
                <button type="button" class="btn btn-sm btn-dark">창닫기</button>
            </div>
        </form>
    </div>
    
    <script type="text/javascript">
    <!--
    function sendData(event) {
        event.preventDefault();
        $('#frm_copy').c2Validate()
            .then(function() {
                return new Promise(function(resolve, reject) {
                    $.ajax({
                        url: '?mod=source',
                        method: 'post',
                        dataType: 'json',
                        data: $('#frm_copy').serialize()
                    })
                    .then(function(result){
                        resolve(result);
                    })
                    .fail(function(error) {
                        reject(error);
                    })
                });
            })
            .then(function(result) {
                alert(result.data);
                opener.location.reload();
                window.close();
            })
            .catch(function(error) {
                console.log(error);
                alert('오류가 발생했습니다')
            });
    }
    
    $(document).ready(function() {
        $('#frm_copy').submit(sendData);
    })
    //-->
    </script>
<?php
include(PATH_C2.'/tail.php');
