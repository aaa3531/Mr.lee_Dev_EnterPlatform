<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;
use kr\c2\site as c2s;

$c2['title'] = '기본설정';
$mm = 0;
include(PATH_LAYOUT.'/default.head.php');

$base_url = $router->getURL();

if (!c2\isval($c2cfg['cf_cms_url'])) {
    $temp = parse_url(c2\get_cur_url());
    $temp2 = explode('/', $temp['path']);
    $paths = array();
    foreach($temp2 as $path) {
        if ($path === 'c2') {
            break;
        }
        $paths[] = $path;
    }
    $paths = array_filter($paths);
    $str_path = '';
    if (count($paths) > 0) {
        $str_path = '/'.implode('/', $paths);
    }
    $cf_cms_url = $temp['scheme'].'://'.$temp['host'].$str_path;
} else {
    $cf_cms_url = $c2cfg['cf_cms_url'];
}
?>

    <div class="container p-3">
        
        <form name="fconfig" id="fconfig" action="<?php echo $base_url?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="act" value="update">
            <div class="tbl_frm01 tbl_wrap">

                <section id="anc_site_basic">
                    <div class="form-group row">
                        <label class="col-2 col-form-label">CMS 설치경로</label>
                        <div class="col-10">
                            <input type="text" name="cf_cms_url" class="form-control" data-c2val="required:true,label:'CMS 설치경로'" value="<?php echo $cf_cms_url?>">
                            <?php echo c2s\help(c2s\get_cms_name().' 가 설치된 전체 URL을 입력해 주세요');?>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-2 col-form-label">글작성자</label>
                        <div class="col-10">
                            <textarea name="cf_user_list" id="cf_user_list" class="form-control" style="min-height: 100px;"><?php echo @implode(PHP_EOL, $c2cfg["cf_user_list"])?></textarea>
                            <?php echo c2s\help("입력한 작성자가 실제 회원아이디와 일치할 경우 해당 회원명의로 등록됩니다");?>
                            <?php echo c2s\help("여러명을 등록할때는 줄바꿈으로 구분합니다")?>
                            <?php echo c2s\help("여러명을 등록했을 경우 랜덤으로 선택이 됩니다")?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">손님비밀번호</label>
                        <div class="col-10">
                            <input type="text" name="cf_user_pwd" class="form-control form-control-inline" value="<?php echo $c2cfg["cf_user_pwd"]?>">
                            <?php echo c2s\help("글작성자가 실제회원으로 존재하지 않는 경우 손님으로 등록이 되며 이때 등록되는 비밀번호입니다");?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Timeout</label>
                        <div class="col-10">
                            <input type="text" name="cf_timeout" id="cf_timeout" size="5" class="form-control form-control-inline text-right" value="<?php echo $c2cfg["cf_timeout"]?>" data-c2val="label:'Timeout',numeric:true">
                            <?php echo c2s\help("한 게시글당 처리 제한 시간(초). 시간초과시 에러로 처리되며 다음으로 넘어갑니다")?>
                            <?php echo c2s\help("권장값: 10, 무제한: -1")?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">메모리제한</label>
                        <div class="col-10">
                            <input type="text" name="cf_memory_limit" id="cf_memory_limit" size="5" class="form-control form-control-inline text-right" value="<?php echo $c2cfg["cf_memory_limit"]?>" data-c2val="label:'Timeout',numeric:true">
                            M Byte
                            <?php echo c2s\help("한 게시글당 메모리 사용량 제한(M Byte)")?>
                            <?php echo c2s\help("권장값: 500, 무제한: -1")?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">인코딩문자셋 추가</label>
                        <div class="col-10">
                            <textarea name="cf_enctype_list" id="cf_enctype_list" class="form-control" style="min-height: 100px;"><?php echo @implode(PHP_EOL, $c2cfg["cf_enctype_list"])?></textarea>
                            <?php echo c2s\help("대상사이트의 인코딩을 선택할 수 있는 옵션을 추가할 수 있습니다")?>
                            <?php echo c2s\help("기본은 utf-8과 euc-kr만 지원됩니다. 추가할 문자셋(Charset)이 있다면 입력해주세요");?>
                            <?php echo c2s\help("여러개는 줄바꿈으로 구분합니다");?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">문자열치환</label>
                        <div class="col-10">
                            <textarea name="cf_replace_string" id="cf_replace_string" class="form-control" style="min-height: 100px"><?php echo @implode(PHP_EOL, $c2cfg["cf_replace_string"])?></textarea>
                            <?php echo c2s\help("특정문자열을 임의의 문자열로 치환합니다");?>
                            <?php echo c2s\help("이 항목을 설정할 경우 모든 대상소스에 적용됩니다.  소스별 설정은 소스관리에서 가능합니다.");?>
                            <?php echo c2s\help("치환이 적용되는 필드는 카테고리, 제목, 본문, 파일명, 댓글 입니다");?>
                            <?php echo c2s\help("<b>\"대상문자열|바꿀문자열\"</b> 형식으로 입력해주세요.");?>
                            <?php echo c2s\help("<b>\"대상문자열|\"</b> 와 같이 바꿀문자열을 생략하면 대상문자열이 삭제됩니다.");?>
                            <?php echo c2s\help("정규식으로 치환하실때에는 <b>\"~정규표현식~옵션|바꿀문자열\"</b> 형식으로 작성해주세요.");?>
                            <?php echo c2s\help("여러개는 줄바꿈으로 구분합니다");?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">이미지 다운로드 제외</label>
                        <div class="col-10">
                            <textarea name="cf_imgexc_domain" id="cf_imgexc_domain" class="form-control"><?php echo @implode(PHP_EOL, $c2cfg["cf_imgexc_domain"])?></textarea>
                            <?php echo c2s\help("입력한 도메인의 이미지는 다운로드 받지 않습니다");?>
                            <?php echo c2s\help("\"http://\"를 제외한 도메인만 입력해주세요")?>
                            <?php echo c2s\help("여러개는 줄바꿈으로 구분합니다");?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">imgur API URL</label>
                        <div class="col-10">
                            <input type="text" name="cf_imgur_url" id="cf_imgur_url" class="form-control" value="<?php echo $c2cfg["cf_imgur_url"]?>">
                            <?php echo c2s\help('- 기본URL: https://api.imgur.com/3/image.json')?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">imgur Client ID</label>
                        <div class="col-10">
                            <input type="text" name="cf_imgur_id" id="cf_imgur_id" class="form-control" value="<?php echo $c2cfg["cf_imgur_id"]?>">
                            <?php echo c2s\help("이미지를 imgur.com 에 업로드할 때 사용합니다.");?>
                            <?php echo c2s\help('<a href="http://api.imgur.com" target="_blank">api.imgur.com</a> 에서 api를 신청 후 사용가능합니다');?>
                            <?php echo c2s\help('imgur 사용시 일반등록보다 등록속도가 느려집니다')?>
                        </div>
                    </div>
                    <!--<div class="form-group row">
                        <label class="col-2 col-form-label">토렌트 설명</label>
                        <div class="col-10">
                            <input type="text" name="cf_torrent_exp" id="cf_torrent_exp" class="form-control" value="<?php echo $c2cfg["cf_torrent_exp"]?>">
                            <?php echo c2s\help("첨부파일이 토렌트 파일일 경우 \"설명\" 부분을 입력한 문구로 수정합니다");?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">토렌트 제작자</label>
                        <div class="col-10">
                            <input type="text" name="cf_torrent_author" id="cf_torrent_author" class="form-control" value="<?php echo $c2cfg["cf_torrent_author"]?>">
                            <?php echo c2s\help("첨부파일이 토렌트 파일일 경우 \"제작자\" 부분을 입력한 문구로 수정합니다");?>
                        </div>
                    </div>-->
                    <div class="form-group row">
                        <label class="col-2 col-form-label">이미지크기제한</label>
                        <div class="col-10">
                            <input type="text" name="cf_img_maxw" id="cf_img_maxw" size="10" value="<?php echo $c2cfg['cf_img_maxw']?>" class="form-control form-control-inline text-center" placeholder="가로크기 (px)">
                            &nbsp;x&nbsp;
                            <input type="text" name="cf_img_maxh" id="cf_img_maxh" size="10" value="<?php echo $c2cfg['cf_img_maxh']?>" class="form-control form-control-inline text-center" placeholder="세로크기 (px)">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">워터마크1</label>
                        <div class="col-10">
                            <?php if(trim($c2cfg["cf_wm_img1"])!="" && file_exists(PATH_DATA."/watermark/".$c2cfg["cf_wm_img1"])){?>
                                    <img src="<?php echo URL_DATA."/watermark/".$c2cfg["cf_wm_img1"]?>" class="img-fluid">
                            <?php }?>
                            <?php echo c2s\help("투명 PNG 파일을 권장합니다")?>
                            <input type="file" name="cf_wm_img1" id="cf_wm_img1" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">워터마크2</label>
                        <div class="col-10">
                            <?php if(trim($c2cfg["cf_wm_img2"])!="" && file_exists(PATH_DATA."/watermark/".$c2cfg["cf_wm_img2"])){?>
                                    <img src="<?php echo URL_DATA."/watermark/".$c2cfg["cf_wm_img2"]?>" class="img-fluid">
                            <?php }?>
                            <?php echo c2s\help("투명 PNG 파일을 권장합니다")?>
                            <input type="file" name="cf_wm_img2" id="cf_wm_img2" class="form-control">
                        </div>
                    </div>
                </section>
                
                <div class="btn_confirm01 btn_confirm text-center">
                    <button type="submit" class="btn btn-primary" accesskey='s'>저장하기</button>
                </div>
            </div>
            
        </form>
    </div>
    
    <script type="text/javascript">
    <!--
    function frmCheck(evt){
        evt.preventDefault();
        
        var data = new FormData(this);
        
        $('#fconfig').c2Validate()
            .then(function() {
                $.ajax({
                    url: '?mod=config',
                    method: 'post',
                    dataType: 'json',
                    data: data,
                    contentType: false,
                    mimeType: 'multipart/form-data',
                    cache: false,
                    processData: false,
                })
                .done(function() {
                    $.confirm({title: '알림', content: '저장되었습니다', buttons: {
                        ok: function() {
                            location.reload();
                        }
                    }});
                })
                .fail(function() {
                   $.alert({title: '오류', content: '저장실패'});
                });
            })
            .catch(function(e) {
                $.alert({title: '오류', content: e.message});
            })
    }
    
    $(document).ready(function() {
        $('#fconfig').submit(frmCheck);
    })
    //-->
    </script>

<?php
include(PATH_LAYOUT.'/default.tail.php');