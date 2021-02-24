<?php
include_once dirname(__DIR__).("/includeFiles.php");

if (isset($_POST['title']) && $_POST['title'] != '' &&
isset($_POST['content']) && $_POST['content'] !='') {

    $movieController = new MovieController();
    $html = $movieController->top20Gridview($_POST['title'], $_POST['content']);
    echo ($html);
}
