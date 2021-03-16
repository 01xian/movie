<?php
include_once dirname(__DIR__).("/Classes/Models/ReviewModel.php");
$checkKey = ['tmdb_id', 'member_id', 'name', 'review'];

foreach ($checkKey as $key) {
    if (!isset($_POST[$key]) || $_POST[$key] == '') {
        echo (json_encode(['result' => false, 'msg' => '請先登入！']));
        exit;
    }
}
$reviewModel = new ReviewModel();
$result = $reviewModel->addReview($_POST['tmdb_id'], $_POST['member_id'], $_POST['name'], $_POST['review']);

if ($result) {
    echo (json_encode(['result' => true, 'msg' => '新增成功！']));
} else {
    echo (json_encode(['result' => false, 'msg' => '新增失敗,請記得登入或聯絡管理員！']));
}

