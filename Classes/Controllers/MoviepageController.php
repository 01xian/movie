<?php
class MoviepageController 
{
    public function movieIntr($tmdbId)
    {
        $movie = curl(MOVIE_API_URL.'movie/'.$tmdbId."?api_key=".API_KEY."&language=".LANGUAGE);
        $movieCast = curl(MOVIE_API_URL.'movie/'.$tmdbId."/".URL_KIND['CAST']."?api_key=".API_KEY."&language=".LANGUAGE);
        $html = '<div class="movieContainer mt-5 row m-auto">
                <div class="moviePoster m-2 col-12 col-md-5"> 
                    <img src="'.IMAGE_URL.'w1280/'.$movie["poster_path"].'" alt="">
                </div>
                <div class="movieContent m-1 col-12  col-md-6">
                    <h1 class="mt-2" id="title">'.$movie["title"].'</h1>
                    <p>'.$movie["release_date"].'</p>
                    ';
                $movieGenre = [];
                foreach ($movie["genres"] as $genre) {
                    $movieGenre[] = $genre["name"];
                }
                 $html .= implode('、', $movieGenre );
                 $favoriteMovieModel = new FavoriteMovieModel();
                 $result = $favoriteMovieModel->checkFavourtite($tmdbId);

                if ($result) {
                    $html .= '<h2><button type="button" id="removeFavorite" class="btn  mt-3 btn-block btn-outline-secondary " ><span class="far fa-window-close fa-lg"></span> 從我的清單中刪除</button></h2>';
                } else {
                    $html .='<h2><button type="button" id="addFavorite" class="btn  mt-3 btn-block btn-outline-danger " ><span class="far fa-kiss-wink-heart fa-lg"></span>加入我的清單</button></h2>';
                }
                $html .=
                    '<input type="hidden"  id="poster_path" value="'.$movie["poster_path"].'">
                    <h3 class="mt-4"> 劇情  </h3>
                    <p id="overview">'.$movie["overview"].'</p>
                    </div>
                </div>
                <div class="cast mt-3 m-auto " >
                    <h3 class="m-1 mb-4">主要演員</h3>
                    <div class="castContainer row">';
                foreach ($movieCast["cast"] as $key => $cast) {
                    if ($key > 7) continue;
                    $html .= '<div class="castDetail m-auto ">';
                    if ($cast["profile_path"]) {
                        $html .= '<img src="'.IMAGE_URL.IMAGE_SIZE['W276H350'].'/'.$cast["profile_path"].'" alt="">';
                    } else {
                        $html .= '<img src="img/noimage.png" alt="">';
                    }
                    $html .= '<span>'.$cast["name"].'</span> </br>
                            <span>'.$cast["character"].'</span>
                        </div>'
                        ;
                }
                $html .= '</div> </div>';
                return $html;
    }

    public function writer()
    {
        if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == 'yes') {
            return (['result' => true, 'data' => json_decode($_SESSION['member_data'], true)]);
    
        } else {
        
            return (['result' => false, 'msg' => '請先 <a href="login.php">登入</a> 哦！']);
        }
    }
    public function showReview($id)
    {
        $reviewModel = new ReviewModel();
        $result = $reviewModel->showReview($id);
        $html = '';
        foreach ($result as $value) {

            $html .= '<div class="review">
                    <div class="card mt-3 border-success ">
                    <div class="caㄉrd-header border-success " style="background-color: #47818680; color:white;">--  作者：'.
                    $value['name']
                    .'</div>
                    <div class="card-body text-secondary">
                        <blockquote class="blockquote mb-0">
                        <p>'.$value['review']
                        .'</p>
                        </blockquote>
                    </div>
                    </div>
                    </div>';
        }
        return $html;
    }
}