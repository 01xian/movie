<?php
include("../pub.php");

$result = checkLogin($_POST['em'], $_POST['pw']);

if ($result){

    login($result);
    echo(json_encode(['result'=>true]));

} else {
    echo(json_encode(['result'=>false, 'msg'=>'帳號或密碼錯誤！']));

}
?>