<?php

/*
 * Effettuo il redirect a main/index.php
*/
require_once 'includes/autoload.inc.php';
require_once 'includes/config.inc.php';

$CHome=USingleton::getInstance('CHome');

if(empty($_POST)!=true && isset($_POST['submit'])) {
    $errore='';
if($_POST['submit'] == 'Upload Image'||$_POST['submit'] == 'Upload Adventure'){
    if ($_POST['submit'] == 'Upload Image')
        $target_file = "/opt/lampp/htdocs/Dandbase_Project/profileimages/" . $_POST['username'];
    if ($_POST['submit'] == 'Upload Adventure')
        $target_file = "/opt/lampp/htdocs/Dandbase_Project/adventuresmap/" . $_POST['username'] . $_POST['nome'];

if($_FILES["fileToUpload"]["tmp_name"]!=false){
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $errore="File is not an image.";
        $uploadOk = 0;
    }
}
if ($uploadOk == 0) {
    $errore=$errore." Your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $errore='Image uploaded correctly!';
    } else {
        $errore="Sorry, there was an error uploading your file.";
    }
}
    $CHome->geterrore($errore);
}
else{
    $errore='You must upload a map!';
    $CHome->geterrore2($errore);
}
}
}

$CHome->impostaPagina();
?>

