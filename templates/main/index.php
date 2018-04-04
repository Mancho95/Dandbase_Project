
<?php

// caricamento delle librerie di Smarty
require('/opt/lampp/htdocs/Dandbase_Project/lib/Smarty/Smarty.class.php');
$smarty = new Smarty;


$smarty->template_dir = '/opt/lampp/htdocs/Dandbase_Project/templates/main/template';
$smarty->compile_dir = '/opt/lampp/htdocs/Dandbase_Project/templates/main/templates_c';
$smarty->config_dir = '/opt/lampp/htdocs/Dandbase_Project/templates/main/config';
$smarty->cache_dir = '/opt/lampp/htdocs/Dandbase_Project/templates/main/cache';

//$smarty->assign('name','Ned');

$smarty->display('index.tpl');
?>