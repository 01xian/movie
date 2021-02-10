<?php
include("../pub.php");
include_once dirname(__DIR__).("/Classes/Models/FavoriteMovieModel.php");
if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == 'yes' &&
    isset($_POST['tmdb_id']) && $_POST['tmdb_id'] != '' && 
    isset($_POST['title']) && $_POST['title'] != '' &&
    isset($_POST['poster_path']) && $_POST['poster_path'] != '' &&
    isset($_POST['overview']) && $_POST['overview'] != '') {
    $member_data = json_decode($_SESSION['member_data']);
    $memberId = $member_data->id;
    $favoriteMovie = new FavoriteMovieModel();
    $result = $favoriteMovie->addFavoriteMovie($memberId, $_POST['tmdb_id'], $_POST['title'], $_POST['poster_path'], $_POST['overview']); 
        if ($result) {
            echo ('加入成功！');
        } else {
            echo ('加入失敗！請聯絡管理員！');
        }
    } else {
        echo ('請先登入！');
    }
?>
