<?php

global $config;

$pathp = '/opt/lampp/htdocs/Dandbase_Project';
$config['smarty']['template_dir'] = $pathp.'/templates/main/template/';
$config['smarty']['compile_dir'] = $pathp.'/templates/main/templates_c/';
$config['smarty']['config_dir'] = $pathp.'/templates/main/configs/';
$config['smarty']['cache_dir'] = $pathp.'/templates/main/cache/';

$config['debug']= false;
$config['mysql']['user'] = 'root';
$config['mysql']['password'] = '';
$config['mysql']['host'] = 'localhost';
$config['mysql']['database'] = 'dnbase';


function debug($var){
    global $config;
    if ($config['debug']){
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}

?>
