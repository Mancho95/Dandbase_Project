<?php
/**
 * Created by PhpStorm.
 * User: xamnoch
 * Date: 09/10/17
 * Time: 17.37
 */
/*
 Main di prova in cui testo le classi per vedere se funzionano come dovrebbero. Non verrà incluso nel progetto finale*/

require_once("EPersonaggio.php");
require_once("EEquipaggiamento.php");
$p=new EPersonaggio();
$e=new EEquipaggiamento();
echo 'Your pg Strenght is '.$p->getForza().' & his modifier is '.$p->getModForza();
echo '                ';
echo '                ';
$p->addEquipaggiamento($e);
try {
    $p->equipaggia();
} catch (Exception $e){
    echo 'caught exception: '.$e->getMessage();
}
    echo 'Hey! Did you equipped something?';
    echo '                ';
    echo '                ';
    echo 'Now your pg Strenght is '.$p->getForza().' & his modifier is '.$p->getModForza();

?>