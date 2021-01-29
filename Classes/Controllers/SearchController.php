<?php
include("../../pub.php");

class SearchController 
{
    public function search($valueToSearch) 
    {
        $query = urlencode($valueToSearch);
        $a = curl('https://api.themoviedb.org/3/search/movie?api_key=408db82bcb709e53e2a0c72c20c6108b&language=zh-TW&query='.$query.'&page=1&include_adult=false');
        $html .= '<h3>搜尋"'.$valueToSearch.'"結果</h3>';           
        foreach ($a["results"] as $movie) {
            if ($movie["poster_path"]) {
                $html .= '<div class="gridViewItem" >
                        <a href="moviePage.php?id='.$movie['id'].'">
                            <img src="https://www.themoviedb.org/t/p/w220_and_h330_face/' . $movie["poster_path"] .'"alt=""> </a> </br>'.$movie['title'].'
    
                    </div>';
            }
        }
        return ($html);
    }
} 
?>