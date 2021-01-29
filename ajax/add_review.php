<?php
include("../pub.php");
$sth = $dbh->prepare('INSERT review (tmdb_id, member_id, name, review) 
                      VALUES (:tmdb_id, :member_id, :name, :review)');
$field = [
    ':tmdb_id' => $_POST['tmdb_id'], 
    ':member_id' => $_POST['member_id'], 
    ':name' => $_POST['name'], 
    ':review' => $_POST['review']
];
if ($sth->execute($field)) {
    echo (json_encode(['result' => true, 'msg' => '新增成功！']));
} else {
    echo (json_encode(['result' => false, 'msg' => '新增失敗,請記得登入或聯絡管理員！']));
}

