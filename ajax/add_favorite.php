<?php
include("../pub.php");
if (isset($_SESSION['is_login']) && $_SESSION['is_login'] == 'yes') {
    $member_data = json_decode($_SESSION['member_data']);
    $member_id = $member_data->id;
    $sth = $dbh->prepare('INSERT favorite_movie (member_id, tmdb_id, title, poster_path, overview, created_at, updated_at)
    VALUES (:member_id, :tmdb_id, :title, :poster_path, :overview, :created_at, :updated_at)');
    $field = [
        ':member_id' => $member_id,
        ':tmdb_id' => $_POST['tmdb_id'] ,
        ':title' => $_POST['title'],
        ':poster_path' => $_POST['poster_path'],
        ':overview' => $_POST['overview'],
        ':created_at' => $datetime, 
        ':updated_at' => $datetime     
    ];
    if ($sth->execute($field)) {
        echo ('加入成功！');
    } else {
        echo ('加入失敗！請聯絡管理員！');
    }



} else {
    echo ('請先登入！');

}
?>
