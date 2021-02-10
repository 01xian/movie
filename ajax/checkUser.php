<?php
include_once dirname(__DIR__).("/Classes/Models/MemberModel.php");
if (isset($_POST['email']) && $_POST['email'] != '') {
    $email = $_POST['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $memberModel = new MemberModel();
        $result = $memberModel->checkEmail($email);
        if ($result) {
            echo(json_encode(["result" => false,'reason'=>'email已註冊過囉！']));
        } else {
            echo(json_encode(["result" => true]));
        }    
    } else {
        echo(json_encode(["result" => false,'reason'=>'email格式不對！']));
    }
} else {
    echo(json_encode(["result" => false,'reason'=>'請填寫email']));
}
?>
