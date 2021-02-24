<?php
include_once dirname(__DIR__, 2).("/pub.php");

class SearchController 
{
    public function search($valueToSearch) 
    {
        $html = '' ;
        $query = urlencode($valueToSearch);
        $a = curl(MOVIE_API_URL.URL_KIND['SEARCH'].'?api_key='.API_KEY.'&language='.LANGUAGE.'&query='.$query.'&page=1&include_adult=false');
        $html .= '<h3>搜尋"'.$valueToSearch.'"結果</h3>';           
        foreach ($a["results"] as $movie) {
            if ($movie["poster_path"]) {
                $html .= '<div class="gridViewItem" >
                        <a href="moviePage.php?id='.$movie['id'].'">
                            <img src="'.IMAGE_URL.IMAGE_SIZE['W220H330'].'/' . $movie["poster_path"] .'"alt=""> </a> </br>'.$movie['title'].'
    
                    </div>';
            }
        }
        return ($html);
    }
} 
?>