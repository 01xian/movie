<?php

class FavoriteController 
{
    public function get_favorite_movie () 
    {
        if ($this->is_login()) {

            $member_data = json_decode($_SESSION['member_data']);
            $member_id = $member_data->id;         

            $favoriteMovieModel = new FavoriteMovieModel();
            $result = $favoriteMovieModel->get_favorite_movie($member_id);
            $html = $this->get_favorite_html($result);
            return ($html);

        } else {
            return ('<div><h2>請先<a href="login.php">登入</a>!</h2></div>');
        }
    }

    public function is_login() 
    {
        if (isset($_SESSION['is_login']) && $_SESSION['is_login'] == 'yes'){
            return true;
        } else {
            return false;
        }
    }

    public function get_favorite_html($result)
    {
        $result = json_decode($result, true);
        foreach ($result as $key=>$value) {
            $html .= '<div class="gridViewItem mt-3 " >
            <a href="moviePage.php?id='.$value['tmdb_id'].'">
            <img src="https://www.themoviedb.org/t/p/w220_and_h330_face/' . $value["poster_path"] .'"alt=""> </a> 
            '.$value['title'].' 
        </div>';
          }
          return $html;
    }
}
?>