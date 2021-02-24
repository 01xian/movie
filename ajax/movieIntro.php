<?php
include_once dirname(__DIR__).("/includeFiles.php");
if (isset($_POST['id']) && $_POST['id'] != '') {
    $moviePage = new MoviepageController();
    $html = $moviePage->movieIntr($_POST['id']);
    echo ($html);
}
?>