<?php
include("../pub.php");
include_once dirname(__DIR__).("/Classes/Models/MemberModel.php");
if (isset($_POST['em']) && $_POST['em'] != '' &&
    isset($_POST['pw']) && $_POST['pw'] != '') {
        $memberModel = new MemberModel();
        $result = $memberModel->checkLogin($_POST['em'], $_POST['pw']);
        if ($result) {
            login($result);
            echo(json_encode(['result'=>true]));
            die;
        }
        echo(json_encode(['result'=>false, 'msg'=>'帳號或密碼錯誤！']));
        die;
} else {
    echo(json_encode(['result'=>false, 'msg'=>'帳號或密碼不得為空']));
}
?>