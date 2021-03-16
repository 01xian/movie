<?php
if (isset($_POST['id']) && $_POST['id'] !='') {
    include_once dirname(__DIR__).("/includeFiles.php");
    $moviePage = new MoviepageController();
    $writer = $moviePage->writer($_POST['id']);
    if ($writer['result']) {
        echo (json_encode([
            'result'=>true,
            'writer'=>"作者：".$writer['data']['name'],
            'name'=>$writer['data']['name'],
            'member_id'=>$writer['data']['id']
        ])); 
    } else {
        echo (json_encode([
            'result'=>false,
            'msg'=>$writer['msg']
        ])); 
    }
}
?>