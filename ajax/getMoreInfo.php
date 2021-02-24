

<?php
include_once dirname(__DIR__).("/includeFiles.php");
if (isset($_GET['page']) && $_GET['page'] != '' &&
    isset($_GET['query']) && $_GET['query'] != '') {
    
    $page = $_GET['page']+1;
    $html = '';
    $query = urlencode($_GET['query']);
    $a = curl(MOVIE_API_URL.URL_KIND['SEARCH'].'?api_key='.API_KEY.'&language='.LANGUAGE.'&query='.$query.'&page='.$page.'&include_adult=false');
    foreach ($a["results"] as $movie) {
        if ($movie["poster_path"]) {
            $html .= '<div class="gridViewItem" >
            <a href="moviePage.php?id='.$movie['id'].'">
                <img src="'.IMAGE_URL.IMAGE_SIZE['W220H330'].'/' . $movie["poster_path"] .'"alt=""> </a> </br>'.$movie['title'].'

            </div>';
        }
    }
    echo (json_encode(['result' => true, 'msg' => 'success', 'datas' => $html]));
    return;
} 

echo json_encode(['result' => false, 'msg' => '無輸入參數']);
die;

?>
