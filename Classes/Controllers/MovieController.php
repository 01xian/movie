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
        $a = curl('http://api.themoviedb.org/3/movie/'.$item.'?api_key=408db82bcb709e53e2a0c72c20c6108b&language=zh-TW&region=TW');
        foreach ($a["results"] as $key => $movie) {
            $html .= '<div class="gridViewItem" >
                      <a href="moviePage.php?id='.$movie['id'].'">
                      <img src="https://www.themoviedb.org/t/p/w220_and_h330_face/' . $movie["poster_path"] .'"alt=""> </a> 
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
            $movie = curl("http://api.themoviedb.org/3/movie/".$id."?api_key=408db82bcb709e53e2a0c72c20c6108b&language=zh-TW");
            $movieCast = curl("https://api.themoviedb.org/3/movie/".$id."/credits?api_key=408db82bcb709e53e2a0c72c20c6108b&language=zh-TW");
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

