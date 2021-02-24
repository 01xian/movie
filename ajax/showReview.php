<?php
if (isset($_POST['id']) && $_POST['id'] != '') {
    include_once dirname(__DIR__).("/includeFiles.php");
    $moviePage = new MoviepageController();
    $html = $moviePage->showReview($_POST['id']);
    echo ($html);
}
