<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;
use kr\c2\site as c2s;
?>
    <section>
        <div class="tbl_frm01 tbl_wrap">
            
            <div class="form-group row">
                <label class="col-2 col-form-label">로그인 Referer</label>
                <div class="col-10">
                    <input type="text" name="sc_login_refer" id="sc_login_refer" value="<?php echo $row["sc_login_refer"]?>" class="sc_long_input form-control form-control-sm">
                    <?php echo c2s\help("대상사이트에서 로그인전의 URL을 체크하는 경우에 해당주소를 입력해 주세요")?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">로그인페이지 URL</label>
                <div class="col-10">
                    <input type="text" name="sc_login_url" id="sc_login_url" value="<?php echo $row["sc_login_url"]?>" class="sc_long_input form-control form-control-sm">
                    <?php echo c2s\help("로그인 아이디와 비밀번호를 입력하는 페이지 URL")?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">로그인처리 URL</label>
                <div class="col-10">
                    <input type="text" name="sc_login_action" id="sc_login_action" value="<?php echo $row["sc_login_action"]?>" class="sc_long_input form-control form-control-sm">
                    <?php echo c2s\help("로그인처리 URL은 크롤러가 자동으로 찾아냅니다")?>
                    <?php echo c2s\help("간혹 자동으로 찾아내지 못할경우 html소스를 분석하여 해당 url을 직접입력해야 합니다")?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">회원아이디</label></th>
                <div class="col-10">
                    <label for="sc_uid_fld" class="sc_uid_fld">필드명</label>
                    <input type="text" name="sc_uid_fld" id="sc_uid_fld" value="<?php echo $row["sc_uid_fld"]?>" class="form-control form-control-sm">
                    <?php echo c2s\help("form 태그내에 회원아이디 입력란의 \"name\"속성의 값을 입력해주세요")?>
                    <?php echo c2s\help('예) &lt;input type="text" name="user_id"&gt; 일 경우 "user_id"')?>
                    <label for="sc_uid_val" class="sc_uid_val">회원아이디</label>
                    <input type="text" name="sc_uid_val" id="sc_uid_val" value="<?php echo $row["sc_uid_val"]?>" class="form-control form-control-sm">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">비밀번호</label>
                <div class="col-10">
                    <label for="sc_pwd_fld">폼필드명</label>
                    <input type="text" name="sc_pwd_fld" id="sc_pwd_fld" value="<?php echo $row["sc_pwd_fld"]?>" class="form-control form-control-sm">
                    <?php echo c2s\help("form 태그내에 비밀번호 입력란의 \"name\"속성의 값을 입력해주세요")?>
                    <?php echo c2s\help('예) &lt;input type="password" name="pwd"&gt; 일 경우 "pwd"')?>
                    <label for="sc_pwd_val" class="sc_pwd_val">비밀번호</label>
                    <input type="text" name="sc_pwd_val" id="sc_pwd_val" value="<?php echo $row["sc_pwd_val"]?>" class="form-control form-control-sm">
                </div>
            </div>
        </div>
    </section>