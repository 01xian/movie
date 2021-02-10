<?php

include_once dirname(__DIR__).'/Classes/Controllers/MovieController.php';

$result = ['result' => false, 'msg' => '缺少傳入參數'];

if (isset($_GET['title'])  && $_GET['title'] != '' &&
    isset($_GET['item']) && $_GET['item'] != '') {
    
    $movieController = new MovieController;
   
    $data = $movieController->top20Gridview($_GET['title'], $_GET['item']);
    
    print_r($data);die;

} else {
    echo json_encode($result);
}