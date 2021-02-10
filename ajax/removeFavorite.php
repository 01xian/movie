<?php
include_once dirname(__DIR__).("/Classes/Models/FavoriteMovieModel.php");
if (isset($_POST['tmdb_id']) && $_POST['tmdb_id']) {
    $FavoriteMovie = new FavoriteMovieModel();
    $result = $FavoriteMovie->deleteFavoriteMovie($_POST['tmdb_id']);
    if ($result) {
        echo ('刪除成功！');
    } else {
        echo('刪除失敗，請再試一次或聯絡管理人員！');
    }
} else {
    echo('刪除失敗，請再試一次或聯絡管理人員！');
}

