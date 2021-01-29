<?php
include("../pub.php");

if (isset($_POST['email']) && $_POST['email'] != '' && 
    isset($_POST['pw']) && $_POST['pw'] != '' &&
    isset($_POST['name']) && $_POST['name'] != '') {


        $sth = $dbh->prepare("INSERT  member (name, email, password, created_at, updated_at) 
                            VALUES (:name, :email, :password, :created_at, :updated_at)");
        $field = [
            ':name' => $_POST['name'], 
            ':email' => $_POST['email'], 
            ':password' => md5($_POST['pw']), 
            ':created_at' => $datetime, 
            ':updated_at' => $datetime
        ];

        if ($sth->execute($field)) {

            $result = checkLogin($_POST['email'], $_POST['pw']);
            login($result);
            echo (json_encode(['result' => true]));
        } else {
            echo (json_encode(['result' => false, 'msg' => '加入會員失敗，請聯絡管理員！']));
        }
    } else {
        echo (json_encode(['result' => false, 'msg' => '資料不齊全！']));
    }
