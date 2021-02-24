<?php

class FavoriteController 
{
    public function getFavoriteMovie() 
    {
        if ($this->isLogin()) {

            $member_data = json_decode($_SESSION['member_data']);
            $member_id = $member_data->id;         

            $favoriteMovieModel = new FavoriteMovieModel();
            $result = $favoriteMovieModel->getFavoriteMovie($member_id);
            $html = $this->getFavoriteHtml($result);
            return ($html);

        } else {
            return ('<div><h2>請先<a href="login.php">登入</a>!</h2></div>');
        }
    }

    public function isLogin() 
    {
        if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == 'yes') {
            return true;
        } else {
            return false;
        }
    }

    public function getFavoriteHtml($result)
    {
        $html = '';
        $result = json_decode($result, true);
        foreach ($result as $key=>$value) {
            $html .= '<div class="gridViewItem mt-3 " >
            <a href="moviePage.php?id='.$value['tmdb_id'].'">
            <img src="'.IMAGE_URL.IMAGE_SIZE['W220H330'].'/' . $value["poster_path"] .'"alt=""> </a> 
            '.$value['title'].' 
        </div>';
          }
        return $html;
    }
}
?>