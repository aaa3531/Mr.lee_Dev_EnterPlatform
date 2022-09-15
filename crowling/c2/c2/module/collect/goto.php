<?php
if(!defined("__C2__")) exit("Access Denied");

use kr\c2 as c2;
use kr\c2\site as c2s;

$board = $input->get('board');

$valid->check('required', 'board', $board, '게시판선택');
if (!$valid->isSuccess()) {
    c2\alert_close($valid->getMessage());
    exit;
}

$url = c2s\Target::getInstance()->getPoster()->getBoardURL($board);
c2\go($url);
