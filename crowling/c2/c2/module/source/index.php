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

//Encoding Type
$enctype = new c2\html\Selectbox();
$enctype->add("utf-8", "UTF-8");
$enctype->add("euc-kr", "EUC-KR");


//===========================================================================
// 페이징
//===========================================================================
$page = (int)c2\binstr($_GET["page"], '1');

$row = $db->select("count(*) as cnt")
    ->table('source')
    ->query()
    ->fetch(\PDO::FETCH_ASSOC);

$total_count = number_format($row['cnt']);

$page_size = 50;

$pg = new c2\util\Pagging();
$pg->setParam(
    c2\util\Pagging::createParam(
        $page, $total_count, $page_size
    )
);
$navdata = $pg->getNaviDatas();
$total_page  = $pg->page_count;
$start_page = $pg->start_page;

$result = $db->select("*")
    ->table("source")
    ->orderby("sc_step")
    ->limit($start_page, $page_size)
    ->query();

$c2['title'] = '소스관리';
$mm = 1;
include(PATH_LAYOUT.'/default.head.php');

$base_url = $router->buildURL();
?>
    <div class="container">
        
        <div class="btn_add01 btn_add my-3 text-right">
            <a href="<?php echo $base_url?>&sec=forms" id="site_add" class="btn btn-sm btn-primary">사이트추가</a>
        </div>

        <form name="frm_list" id="frm_list" action="<?php echo $base_url?>" method="post">
        <input type="hidden" name="act" id="act" value="">
        <input type="hidden" name="page" value="<?php echo $page?>">
        
        <table class="table table-sm table-bordered table-hover">
        <thead>
        <tr>
            <th scope="col">
                <label for="allchk" class="sr-only">사이트 전체</label>
                <input type="checkbox" name="allchk" value="1" id="allchk">
            </th>
            <th scope="col">고유번호</th>
            <th scope="col">제목/이름</th>
            <th scope="col">도메인</th>
            <th scope="col">등록게시판</th>
            <th scope="col">엔코딩타입</th>
            <th scope="col">딜레이</th>
            <th scope="col">순서</th>
            <th scope="col">활성여부</th>
            <th scope="col">편집</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $row = $result->fetch(\PDO::FETCH_ASSOC); $i++) {
            $one_update = '<a href="'.$base_url.'&sec=forms&sc_idx='.$row['sc_idx'].'&page='.$page.'">수정</a>';
            $temp = parse_url($row["sc_list_url"]);
            if(isset($temp["scheme"]) && $temp["scheme"] != "")
                $domain = $temp["scheme"]."://".$temp["host"];
            else
                $domain = "";
        ?>
        <tr>
            <td class="text-center">
                <label for="chk_<?php echo $i; ?>" class="sr-only"><?php echo $row['sc_name']?></label>
                <input type="checkbox" name="chk[]" class="chk" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
                <input type="hidden" name="sc_idx[<?php echo $i?>]" class="sc-idx" value="<?php echo $row["sc_idx"]?>">
            </td>
            <td class="text-center">
                <?php echo $row["sc_idx"]?>
            </td>
            <td>
                <?php echo $row["sc_name"]?>
            </td>
            <td>
                <?php echo $domain?>
            </td>
            <td class="text-center">
                <select name="board[<?php echo $i?>]" class="form-control form-control-sm">
                    <option value="">=선택안함=</option>
                    <?php
                    $b_s->selectedFromValue = $row["board"];
                    echo $b_s->getOption();
                    ?>
                </select>
            </td>
            <td class="text-center">
                <select name="sc_enctype[<?php echo $i?>]" class="form-control form-control-sm">
                    <?php
                    $enctype->selectedFromValue = $row["sc_enctype"];
                    echo $enctype->getOption();
                    ?>
                </select>
            </td>
            <td class="text-center">
                <input type="text" name="sc_delay[<?php echo $i?>]" value="<?php echo $row["sc_delay"]?>" size="10" class="form-control form-control-sm text-right">
            </td>
            <td class="text-center">
                <input type="text" name="sc_step[<?php echo $i?>]" value="<?php echo $row["sc_step"]?>" size="10" class="form-control form-control-sm text-right">
            </td>
            <td class="text-center">
                <input type="checkbox" id="sc_use_<?php echo $i?>" name="sc_use[<?php echo $i?>]" value="1" <?php echo $row["sc_use"]==1 ? 'checked="checked"' : '';?>>
                <label for="sc_use_<?php echo $i?>" class="sr-only"><?php echo $row['sc_name']?> 사용함</label>
            </td>
            <td class="text-center">
                <?php echo $one_update ?>
            </td>
        </tr>
        <?php }?>
        </tbody>
        </table>

        <div id="btns">
            <button type="button" class="btn btn-sm btn-primary" data-type="edit">선택수정</button>
            <button type="button" class="btn btn-sm btn-success" data-type="copy">소스복사</button>
            <button type="button" class="btn btn-sm btn-danger" data-type="del">선택삭제</button>
        </div>

        <div class="text-center">
            <?php echo c2\site\pagination($base_url, $navdata, $page)?>
        </div>

        <script type="text/javascript">
        <!--
        function copy() {
            
            var idxs = $(document.getElementsByName('sc_idx[]'));
            
            var cnt = $('.chk:checked').size();
            var idx = $('.chk:checked:eq(0)').val();
            var sc_idx = $('.sc-idx').eq(idx).val();
            
            if(cnt <= 0){
                alert('복사할 소스를 선택해 주세요');
                return;
            }else if(cnt > 1){
                alert('하나의 소스만 선택해 주세요');
                return;
            }
            
            c2.Win.open('?mod=source&sec=copy&sc_idx=' + sc_idx, 'cwin', 500, 400);
        }
        
        function edit() {
            var cnt = $('.chk:checked').size();
            if(cnt <= 0){
                alert('수정할 항목을 선택해 주세요');
                return;
            }
            $('#act').val('list_edit');
            $('#frm_list').submit();
        }
        
        function remove() {
            var cnt = $('.chk:checked').size();
            if(cnt <= 0){
                alert('삭제할 항목을 선택해 주세요');
                return;
            }
            if(!confirm('정말 삭제할까요?')) return;
            $('#act').val('list_delete');
            $('#frm_list').submit();
        }

        $(function(){
            $('#btns button').click(function(event){
                event.preventDefault();
                var type = $(this).data('type');
                if (type === 'copy') copy();
                if (type === 'edit') edit();
                if (type === 'del') remove();
            });
        });
        //-->
        </script>
    </div>
<?php
include(PATH_LAYOUT.'/default.tail.php');
