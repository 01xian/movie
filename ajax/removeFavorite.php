<?php
include("../pub.php");

$sth = $dbh->prepare('DELETE FROM favorite_movie WHERE tmdb_id = ? ');
if ($sth->execute(array($_POST['tmdb_id']))) {
    echo ('刪除成功！');
} else {
    echo('刪除失敗，請再試一次或聯絡管理人員！');
}
