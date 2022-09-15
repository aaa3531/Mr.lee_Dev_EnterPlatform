<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;
use kr\c2\site as c2s;

//게시판 목록
$blist = c2s\Target::getInstance()->poster->fetchAll();

$b_s = new c2\html\Selectbox();
foreach($blist as $key => $val){
    $b_s->add($key, $val);
}

$result = $db->select("*")->table("source")->where("sc_use=1")->orderby("sc_step")->query();

$c2['title'] = '수집하기';
$mm = 2;
include(PATH_LAYOUT.'/default.head.php');
include_once(PATH_INC.'/datepicker.php');
$htmlheader->addScript($router->getRealURL().'/js/collect.js');
?>
    <div class="container collect">
    
        <div class="card mb-2">
            <div class="card-header">
                <input type="checkbox" id="allchk" value="1">
                <label for="allchk">모두선택 / 모두해제</label>
            </div>
            <div class="card-body">
                <ul class="source-list">
                <?php
                $hosts = array();
                for($i=0; $row = $result->fetch(\PDO::FETCH_ASSOC); $i++){
                    $temp = parse_url($row["sc_list_url"]);
                    
                    //사이트별 로그인을 한번만 하기 위해서
                    if(isset($temp["hostname"]) && !in_array($temp["hostname"], $hosts)){
                        $first_domain="yes";
                        $hosts[] = $temp["hostname"];
                    }else $first_domain="no";
                ?>
                    <li>
                        <input type="checkbox" id="source_<?php echo $i?>" class="source chk"
                            data-sc_idx="<?php echo $row["sc_idx"]?>"
                            data-sc_name="<?php echo $row["sc_name"]?>"
                            data-first_domain="<?php echo $first_domain?>"
                            data-spage="<?php echo $row["sc_spage"]?>"
                            data-epage="<?php echo $row["sc_epage"]?>"
                            data-delay="<?php echo $row["sc_delay"]?>">
                        <label for="source_<?php echo $i?>"><?php echo $row["sc_name"]?></label>
                    </li>
                <?php }?>
                </ul>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-header">
                <input type="checkbox" id="period" value="1">
                <label for="period">가상 등록날짜 사용함</label>
            </div>
            <div class="card-body">
                <input type="text" id="sdate" class="form-control form-control-sm form-control-inline datepicker" readonly="readonly" size="11" maxlength="10">
                ~
                <input type="text" id="edate" class="form-control form-control-sm form-control-inline datepicker" readonly="readonly" size="11" maxlength="10" value="<?php echo date("Y-m-d")?>">
            </div>
        </div>
    
        <div class="mb-2 d-flex justify-content-between">
            <div>
                <button type="button" id="btn_start" class="btn btn-sm btn-dark">목록수집</button>
                <button type="button" id="btn_mix" class="btn btn-sm btn-dark">목록섞기</button>
            </div>
            <div>
                <select name="board" id="board" class="form-control form-control-sm form-control-inline">
                    <option value="">= 게시판 선택 =</option>
                    <?php echo $b_s->getOption();?>
                </select>
                <button type="button" id="btn_import" class="btn btn-sm btn-dark">등록하기</button>
                <button type="button" id="btn_rmcomplete" class="btn btn-sm btn-dark">완료항목 제외</button>
                <button type="button" id="btn_board" class="btn btn-sm btn-dark">게시판이동</button>
            </div>
        </div>
        
        <table class="table table-bordered table-sm table-hover">
        <thead>
        <tr>
            <th class="col-sc-name">소스이름</th>
            <th class="col-sc-list-url">URL</th>
            <th class="col-sc-title">글제목</th>
            <th class="col-sc-regdate">작성날짜</th>
            <th class="col-sc-status">등록상태</th>
            <th class="col-sc-del">삭제</th>
        </tr>
        </thead>
        <tbody id="list">
        </tbody>
        </table>
        
    </div>
    
    <div id="loading">
        <div class="mask"></div>
        <div class="loader">
            <div class="text-center mb-2"><img src="<?php echo $router->getRealURL()?>/img/loader.svg"></div>
            <div class="text-center"><button type="button" id="btn_stop" class="btn btn-dark">중지하기</button></div>
        </div>
    </div>
    
    <!-- row 템플릿 -->
    <table id="row_tpl" class="d-none">
    <tr class="trow">
        <td class="sc-name"></td>
        <td class="sc-list-url"><a href="#" target="_blank"></a></td>
        <td class="sc-title"></td>
        <td class="sc-regdate">-</td>
        <td class="sc-state">-</td>
        <td class="sc-del"><button type="button" class="btn btn-dark btn-sm btn-del">삭제</button></td>
    </tr>
    </table>
    <!-- //row 템플릿 -->
    
    <script type="text/javascript">
    <!--
    $(document).ready(function() {
        $('.datepicker').datepicker();
    })
    //-->
    </script>
<?php
include(PATH_LAYOUT.'/default.tail.php');
