<?php
include("../../pub.php");

class MovieController 
{
    public function top20Gridview($title, $item)
    {
        global $dbh;
        $html = '<h2 class="mb-3" >'.$title.'</h2>';
        $movieTop20Id = []; 
        $a = curl('http://api.themoviedb.org/3/movie/'.$item.'?api_key=408db82bcb709e53e2a0c72c20c6108b&language=zh-TW');
        foreach ($a["results"] as $key => $movie) {
            $html .= '<div class="gridViewItem" >
                      <a href="moviePage.php?id='.$movie['id'].'">
                      <img src="https://www.themoviedb.org/t/p/w220_and_h330_face/' . $movie["poster_path"] .'"alt=""> </a> 
                      TOP  '.($key+1).'</br>'.$movie['title'].' 
                  </div>';
                  $movieTop20Id[] = $movie['id'];             
        }
        $ids = implode(',', $movieTop20Id);
        $sth = $dbh->prepare('SELECT * FROM movie WHERE tmdb_id IN ('.$ids.') ');
        $sth->execute();
        $result = $sth->fetchAll();
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
    
            $sth = $dbh->prepare('INSERT movie (tmdb_id, name, poster_path, genre, release_date, overview, cast_poster_path, created_at, updated_at) VALUES (:tmdb_id, :name, :poster_path, :genre, :release_date, :overview, :cast_poster_path, :created_at, :updated_at)');
            $field = [
                ':tmdb_id' => $id, 
                ':name' => $movie["title"], 
                ':poster_path' => $movie["poster_path"], 
                ':genre' => json_encode($movie["genres"]), 
                ':release_date' => $movie["release_date"], 
                ':overview' => $movie["overview"], 
                ':cast_poster_path' => json_encode($cast), 
                ':created_at' => $datetime, 
                ':updated_at' => $datetime
            ];
           
            $sth->execute( $field );
    
        }
        return ($html);
    }

}
?>
