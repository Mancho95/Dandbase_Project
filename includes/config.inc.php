<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

global $config;

$config['smarty']['template_dir'] =
'home/Scrivania/ProgrammazioneWeb/Dandbase_Project/templates/main/cache/';
$config['smarty']['compile_dir'] =
'home/Scrivania/ProgrammazioneWeb/Dandbase_Project/templates/main/templates_c/';
$config['smarty']['config_dir'] =
'home/Scrivania/ProgrammazioneWeb/Dandbase_Project/templates/main/configs/';
$config['smarty']['cache_dir'] =
'home/Scrivania/ProgrammazioneWeb/Dandbase_Project/templates/main/cache/';

$config['debug']= false;
$config['db']['type'] = 'mysql';
$config['db']['user'] = 'root';
$config['db']['password'] = '';
$config['db']['host'] = '127.0.0.1';
$config['db']['dbname'] = 'dnbase';


function debug($var){
    global $config;
    if ($config['debug']){
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}

?>
