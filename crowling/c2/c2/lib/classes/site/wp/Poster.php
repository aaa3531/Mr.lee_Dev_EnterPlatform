<?php
namespace kr\c2\site\wp;

use kr\c2 as c2;
use kr\c2\site as c2s;

class Poster extends c2s\APoster{
    
//    private $is_break_cmt = false;
//    private $write_table = '';
//    private $board_table = '@'.G5_PREFIX.'board';
//    private $member_table = '@'.G5_PREFIX.'member';
//    private $board_new_table = '@'.G5_PREFIX.'board_new';
//    private $board_file_table = '@'.G5_PREFIX.'board_file';

    private $wp;
    private $categories;
    
    public function __construct() {
        parent::__construct();
        $this->wp = new \HieuLe\WordpressXmlrpcClient\WordpressClient();
        $this->wp->setCredentials(
            "http://wp.kbay.co.kr/xmlrpc.php",
            "cong2",
            "Park5779@5779"
        );
    }
    
    public function fetchAll() {
        if (!$this->boards) {
            $this->categories = $this->wp->getTerms("category");
            foreach($this->categories as $taxonomy) {
                if ($taxonomy['parent'] !== 0) continue;
                $this->boards[$taxonomy['term_id']] = $taxonomy['name'];
            }
        }
        return $this->boards;
    }
    
    public function checkOverlap($oc_key){
        
    }
    
    public function getDownloadImagePaths($board){}
    public function getDownloadFilePaths($board){}
    
    public function write(){
        $this->wp->newPost()
    }
    
    public function cwrite(){}
    public function getBoardURL($board){}
    public function existBoard($board){}
    
    /*
    public function checkOverlap($oc_key) {
        //중복검사 - 내용으로 검사
        $cnt = $this->db->select("count(*)")
            ->table($this->write_table)
            ->where("wr_10=?", $oc_key)
            ->limit(1)->query()->fetchColumn(0);
        
        if ($cnt > 0) return false;
        return true;
    }
    
    public function getDownloadImagePaths($board) {
        $ym = date('ym');
        return array(
            PATH_C2.'/../data/editor/'.$ym,
            $this->cfg['cf_cms_url'].'/data/editor/'.$ym,
        );
    }
    
    public function getDownloadFilePaths($board) {
        return array(
            PATH_C2.'/../data/file/'.$board,
            $this->cfg['cf_cms_url'].'/data/file/'.$board,
        );
    }
    
    public function setBoard($board) {
        parent::setBoard($board);
        $this->write_table = '@'.G5_PREFIX.'write_'.$board;
    }
    
    protected function getEncryptString($pwd) {
        return $this->db->query("select password(?)", $pwd)->fetchColumn(0);
    }
    
    protected function getAuthor($writer, $is_cmt=false){

        $winfo = array();
        
        if(c2\isval($writer)){
            $winfo["mb_id"] = "";
            $winfo["mb_name"] = $writer;
            $winfo["mb_nick"] = "";
            $winfo["mb_level"] = 1;
            $winfo["mb_password"] = $this->getEncryptString($this->cfg["cf_user_pwd"]);
            $winfo["mb_email"] = "";
            $winfo["mb_homepage"] = "";
            
        }else{
            $writer = $this->users[mt_rand(0, count($this->users)-1)];
            $member = $this->getMember($writer);
            if($member){
                $winfo["mb_id"] = $member["mb_id"];
                $winfo["mb_name"] = $member["mb_name"];
                $winfo["mb_nick"] = $member["mb_nick"];
                $winfo["mb_level"] = $member["mb_level"];
                $winfo["mb_password"] = $member['mb_password'];
                $winfo["mb_email"] = addslashes($member['mb_email']);
                $winfo["mb_homepage"] = addslashes(clean_xss_tags($member['mb_homepage']));
                
            } else {
                $winfo["mb_id"] = '';
                // 비회원의 경우 이름이 누락되는 경우가 있음
                $winfo["mb_name"] = $writer;
                $winfo["mb_nick"] = "";
                $winfo["mb_level"] = 1;
                $winfo["mb_password"] = $this->getEncryptString($this->cfg["cf_user_pwd"]);
                $winfo["mb_email"] = "";
                $winfo["mb_homepage"] = "";
            }
        }
        
        return $winfo;

    }
    
    protected function getMember($mb_id) {
        return $this->db->select("*")
            ->table($this->member_table)
            ->where("mb_id=?", $mb_id)
            ->query()->fetch(\PDO::FETCH_ASSOC);
    }
    
    protected function getNextNum()
    {
        $num = $this->db->select("min(wr_num)")
            ->table($this->write_table)
            ->query()->fetchColumn(0);
        
        return (int)($num - 1);
    }
    
    public function write(){
        
        $wr_num = $this->getNextNum();
        
        foreach($this->data as $key => $value){
            c2\varset($this->data[$key]);
        }
        
        $member = $this->getAuthor($this->data["writer"]);
        $wr_datetime = $this->getDateString($this->data["regdate"]);
        
        $wr_caname = c2\varset($this->data["cate"]);
        $wr_subject = c2\entities_to_unicode(trim(c2\varset($this->data["subject"])));
        $wr_content = c2\entities_to_unicode(trim(c2\varset($this->data["content"])));
        $wr_link_1 = c2\varset($this->data["wr_link"][0]);
        $wr_link_2 = c2\varset($this->data["wr_link"][1]);
        $wr_hit = preg_replace("~[^0-9]+~isx", "", c2\varset($this->data["read"]));
        $wr_good = preg_replace("~[^0-9]+~isx", "", c2\varset($this->data["wr_good"]));
        $wr_nogood = preg_replace("~[^0-9]+~isx", "", c2\varset($this->data["wr_nogood"]));
        
        $wr_name = c2\isval($member['mb_nick']) ? $member['mb_nick'] : $member['mb_name'];
        $wr_1 = c2\varset($this->data["ex_1"]);
        $wr_2 = c2\varset($this->data["ex_2"]);
        $wr_3 = c2\varset($this->data["ex_3"]);
        $wr_4 = c2\varset($this->data["ex_4"]);
        $wr_5 = c2\varset($this->data["ex_5"]);
        $wr_6 = c2\varset($this->data["ex_6"]);
        $wr_7 = c2\varset($this->data["ex_7"]);
        $wr_8 = c2\varset($this->data["ex_8"]);
                
        $wr_option = "";
        
        //사용자정의 데이타 조작파일
        @include(PATH_PLUGIN."/before_insert.php");
        
        //입력 중단이면
        if($this->is_break) return;
        
        $arr = array();
        $arr['wr_num'] = $wr_num;
        $arr['wr_reply'] = '';
        $arr['wr_comment'] = 0;
        $arr['ca_name'] = $wr_caname;
        $arr['wr_option'] = 'html1,'.$wr_option;
        $arr['wr_subject'] = $wr_subject;
        $arr['wr_content'] = $wr_content;
        $arr['wr_link1'] = $wr_link_1;
        $arr['wr_link2'] = $wr_link_2;
        $arr['wr_link1_hit'] = 0;
        $arr['wr_link2_hit'] = 0;
        $arr['wr_hit'] = $wr_hit;
        $arr['wr_good'] = $wr_good;
        $arr['wr_nogood'] = $wr_nogood;
        $arr['mb_id'] = $member["mb_id"];
        $arr['wr_password'] = $member["mb_password"];
        $arr['wr_name'] = $wr_name;
        $arr['wr_email'] = $member["mb_email"];
        $arr['wr_homepage'] = $member["mb_homepage"];
        $arr['wr_datetime'] = $wr_datetime;
        $arr['wr_last'] = $wr_datetime;
        $arr['wr_ip'] = c2\binstr($_SERVER['REMOTE_ADDR'], '');
        $arr['wr_file'] = count(c2\varset($this->data["file"]));

        $arr['wr_1'] = $wr_1;
        $arr['wr_2'] = $wr_2;
        $arr['wr_3'] = $wr_3;
        $arr['wr_4'] = $wr_4;
        $arr['wr_5'] = $wr_5;
        $arr['wr_6'] = $wr_6;
        $arr['wr_7'] = $wr_7;
        $arr['wr_8'] = $wr_8;

        // 중복체크를 위한 필드
        $arr['wr_10'] = c2\varset($this->data["oc_key"]);
        
        
        $arr['wr_comment_reply'] = '';
        
        try {
            $this->db->insert($this->write_table, $arr);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        
        $this->wr_id = $this->db->lastInsertId();
        
        // 부모 아이디에 UPDATE
        $arr = array();
        $arr['wr_parent'] = $this->wr_id;
        $this->db->update($this->write_table, $arr, array("wr_id=?", $this->wr_id));
        
        // 새글 INSERT
        $arr = array();
        $arr['bo_table'] = $this->board;
        $arr['wr_id'] = $this->wr_id;
        $arr['wr_parent'] = $this->wr_id;
        $arr['bn_datetime'] = date('Y-m-d H:i:s');
        $arr['mb_id'] = $member['mb_id'];
        
        // 기타 값이 없는 필드 (에러방지)
        $this->db->insert($this->board_new_table, $arr);
        
        // 게시글 1 증가
        $arr = array();
        $arr['@bo_count_write'] = 'bo_count_write + 1';
        $this->db->update($this->board_table, $arr, array("bo_table=?", $this->board));
        
        
        //------------------------
        // 파일등록
        //------------------------
        if(is_array(c2\varset($this->data["file"]))){
            
            for($i=0;$i<count($this->data["file"]);$i++){
                $arr = array();
                $arr['bo_table'] = $this->board;
                $arr['wr_id'] = $this->wr_id;
                $arr['bf_no'] = $i;
                $arr['bf_source'] = $this->data['file'][$i]['vname'];
                $arr['bf_file'] = $this->data['file'][$i]['rname'];
                $arr['bf_content'] = '';
                $arr['bf_download'] = 0;
                $arr['bf_filesize'] = $this->data['file'][$i]['size'];
                $arr['bf_width'] = $this->data['file'][$i]['width'];
                $arr['bf_height'] = $this->data['file'][$i]['height'];
                $arr['bf_type'] = $this->data['file'][$i]['img_type'];
                $arr['bf_datetime'] = $wr_datetime;
                $this->db->insert($this->board_file_table, $arr);
            }
        }

        //사용자정의 데이타 조작파일
        @include(PATH_PLUGIN."/after_insert.php");
        
        $this->deleteCacheLatest($this->board);
    }
    
    // 게시판 최신글 캐시 파일 삭제
    protected function deleteCacheLatest()
    {
        if (!preg_match("/^([A-Za-z0-9_]{1,20})$/", $this->board)) {
            return;
        }

        $files = glob(G5_DATA_PATH.'/cache/latest-'.$this->board.'-*');
        if (is_array($files)) {
            foreach ($files as $filename)
                unlink($filename);
        }
    }
    
    public function cwrite()
    {
        if (!is_array($this->cmt_list) ||
            !isset($this->cmt_list["ccontent"]) ||
            count($this->cmt_list["ccontent"]) <= 0
        ) return;
                
        for($_ci=0; $_ci<count($this->cmt_list["ccontent"]); $_ci++){
            
            @include(PATH_PLUGIN."/before_insert_comment.php");
        
            //입력 중단이면
            if($this->is_break_cmt) return;
            
            $member = $this->getAuthor($this->cmt_list["cwriter"][$_ci], true);
            
            $wr = $this->db->select("*")
                ->table($this->write_table)
                ->where("wr_id=?", $this->wr_id)
                ->query()->fetch(\PDO::FETCH_ASSOC);
            
            $tmp_comment = $this->db->select("max(wr_comment)")
                ->table($this->write_table)
                ->where("wr_parent=? AND wr_is_comment=1", $this->wr_id)
                ->query()->fetchColumn(0);
            
            $tmp_comment++;
            $tmp_comment_reply = '';
            
            $wr_subject = $wr['wr_subject'];
            $wr_subject = c2\entities_to_unicode($wr_subject);
            
            $wr_content = preg_replace("~<br[^>]*>~is", "\r\n", trim($this->cmt_list["ccontent"][$_ci]));
            $wr_content = c2\entities_to_unicode($wr_content);
            
            $wr_datetime = $this->getDateString($this->cmt_list["cdate"][$_ci]);
            $wr_good = c2\binstr($this->cmt_list["good"][$_ci], 0);
            $wr_nogood = c2\binstr($this->cmt_list["nogood"][$_ci], 0);
            
            $mb_id = $member["mb_id"];
            $wr_password = $member["mb_password"];
            $wr_name = c2\binstr($member['mb_nick'], $member['mb_name']);
            $wr_email = $member["mb_email"];
            $wr_homepage = $member["mb_homepage"];
            
            $arr = array();
            $arr['ca_name'] = $wr['ca_name'];
            $arr['wr_option'] = 'html1';
            $arr['wr_num'] = $wr['wr_num'];
            $arr['wr_reply'] = '';
            $arr['wr_parent'] = $this->wr_id;
            $arr['wr_is_comment'] = 1;
            $arr['wr_comment'] = $tmp_comment;
            $arr['wr_comment_reply'] = $tmp_comment_reply;
            $arr['wr_subject'] = '';
            $arr['wr_content'] = $wr_content;
            $arr['wr_good'] = $wr_good;
            $arr['wr_nogood'] = $wr_nogood;
            $arr['mb_id'] = $mb_id;
            $arr['wr_password'] = $wr_password;
            $arr['wr_name'] = $wr_name;
            $arr['wr_email'] = $wr_email;
            $arr['wr_homepage'] = $wr_homepage;
            $arr['wr_datetime'] = $wr_datetime;
            $arr['wr_last'] = '';
            $arr['wr_ip'] = $_SERVER["REMOTE_ADDR"];
            
            $this->db->insert($this->write_table, $arr);
            
            $comment_id = $this->db->lastInsertId();
            
            // 원글에 댓글수 증가 & 마지막 시간 반영
            $arr = array();
            $arr['@wr_comment'] = "wr_comment + 1";
            $arr['wr_last'] = date('Y-m-d H:i:s');
            $this->db->update($this->write_table, $arr, array("wr_id=?", $this->wr_id));
            
            // 새글 INSERT
            $arr = array();
            $arr['bo_table'] = $this->board;
            $arr['wr_id'] = $comment_id;
            $arr['wr_parent'] = $this->wr_id;
            $arr['bn_datetime'] = date('Y-m-d H:i:s');
            $arr['mb_id'] = $member['mb_id'];
            $this->db->insert($this->board_new_table, $arr);
            
            // 댓글 1 증가
            $arr = array();
            $arr['@bo_count_comment'] = "bo_count_comment+1";
            $this->db->update($this->board_table, $arr, array("bo_table=?", $this->board));
            
            // 사용자 코드 실행
            //@include_once($board_skin_path.'/write_comment_update.skin.php');
            //@include_once($board_skin_path.'/write_comment_update.tail.skin.php');
            
            @include(PATH_PLUGIN."/after_insert_comment.php");
            
        }
        
        $this->deleteCacheLatest();
    }
    
    public function getBoardURL($board) {
        return $this->cfg['cf_cms_url'].'/bbs/board.php?bo_table='.$board;
    }
    
    public function existBoard($board) {
        $cnt = $this->db
            ->select("count(*)")
            ->table($this->board_table)
            ->where("bo_table=?", $board)
            ->query()->fetchColumn(0);
        if($cnt > 0) return true;
        return false;
    }
    
    public static function getInstance() {
        static $inst = null;
        if ($inst === null){
            $inst = new Poster();
        }
        return $inst;
    }
    */
}