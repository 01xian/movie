<?php

include_once dirname(__DIR__, 2).("/pub.php");
include_once dirname(__DIR__).("/Models/MovieModel.php");

class MovieController 
{
    public function top20Gridview($title, $item)
    {
        global $dbh;
        $html = '<h2 class="mb-3" >'.$title.'</h2>';
        $movieTop20Id = []; 
        $a = curl(MOVIE_API_URL.'movie/'.$item.'?api_key='.API_KEY.'&language='.LANGUAGE.'&region='.REGION);
        foreach ($a["results"] as $key => $movie) {
            $html .= '<div class="gridViewItem" >
                      <a href="moviePage.php?id='.$movie['id'].'">
                      <img src="'.IMAGE_URL.IMAGE_SIZE['W220H330'].'/' . $movie["poster_path"] .'"alt=""> </a> 
                      TOP  '.($key+1).'</br>'.$movie['title'].' 
                  </div>';
                  $movieTop20Id[] = $movie['id'];             
        }
        $ids = implode(',', $movieTop20Id);
        $movieModel = new MovieModel();
        $result = $movieModel->movie($ids);
        $movieindb = [];  
        foreach ($result as $value) {
            $movieindb[] = $value['tmdb_id'];
        }
    
        $insertmovieid = [];
        foreach ($movieTop20Id as $id) {
            if (!in_array($id, $movieindb)) {
                $insertmovieid[] = $id;
            }
        }
      
        foreach($insertmovieid as $id) {
            $movie = curl(MOVIE_API_URL.URL_KIND['MOVIE'].$id."?api_key=".API_KEY."&language=".LANGUAGE);
            $movieCast = curl(MOVIE_API_URL.URL_KIND['MOVIE'].$id."/".URL_KIND['CAST']."?api_key=".API_KEY."&language=".LANGUAGE);
            $cast = [];
            foreach ($movieCast["cast"] as $key => $value) {
                if ($key > 7) continue;
                $cast[$value["name"]] = $value["character"];
            } 
            $movieModel->insertMovie($id, $movie["title"], $movie["poster_path"], $movie["genres"], $movie["release_date"], $movie["overview"], $cast);
        }
        return ($html);
    }

}

