<?php
$database = array(
    'base' => array(),
    'target' => array(),
);

// 크롤러 DB
$database['base']['dbms'] = 'mysql';
$database['base']['host'] = '{{base_host}}';
$database['base']['username'] = '{{base_username}}';
$database['base']['password'] = '{{base_password}}';
$database['base']['dbname'] = '{{base_dbname}}';
$database['base']['prefix'] = '{{base_prefix}}';
$database['base']['port'] = '{{base_port}}';
$database['base']['charset'] = 'utf8';

// 저장될 DB
$database['target']['dbms'] = 'mysql';
$database['target']['host'] = '{{target_host}}';
$database['target']['username'] = '{{target_username}}';
$database['target']['password'] = '{{target_password}}';
$database['target']['dbname'] = '{{target_dbname}}';
$database['target']['prefix'] = '{{target_prefix}}';
$database['target']['port'] = '{{target_port}}';
$database['target']['charset'] = 'utf8';
