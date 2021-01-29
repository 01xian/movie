<?php
include("../pub.php");
$email = $_POST['email'];
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $sth = $dbh->prepare("SELECT * FROM member WHERE email = '{$email}'");
    $sth->execute();
    $result = $sth->fetch();

    if ($result) {
        echo(json_encode(["result" => false,'reason'=>'email已註冊過囉！']));
    } else {
        echo(json_encode(["result" => true]));
    }

} else {
    echo(json_encode(["result" => false,'reason'=>'email格式不對！']));
}


?>
