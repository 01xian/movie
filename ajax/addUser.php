<?php
include_once dirname(__DIR__).("/Classes/Models/MemberModel.php");

if (isset($_POST['email']) && $_POST['email'] != '' && 
    isset($_POST['pw']) && $_POST['pw'] != '' &&
    isset($_POST['name']) && $_POST['name'] != '') {
        $memberModel = new MemberModel();
        $addUser = $memberModel->addUser($_POST['name'], $_POST['email'], $_POST['pw']);
        if ($addUser) {
            $result = $memberModel->checkLogin($_POST['email'], $_POST['pw']);
            login($result);
            echo (json_encode(['result' => true]));
        } else {
            echo (json_encode(['result' => false, 'msg' => '加入會員失敗，請聯絡管理員！']));
        }
    } else {
        echo (json_encode(['result' => false, 'msg' => '資料不齊全！']));
    }
