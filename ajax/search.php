<?php
include_once dirname(__DIR__).("/includeFiles.php");

if (isset($_POST['valueToSearch']) && $_POST['valueToSearch'] != '') {

    $indexController = new SearchController();
    $indexSearchHtml = $indexController->search($_POST['valueToSearch']);
    echo($indexSearchHtml);
}
    

?>