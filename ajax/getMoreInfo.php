

<?php
include("../pub.php");

if (isset($_GET['page']) && $_GET['page'] != '' &&
    isset($_GET['query']) && $_GET['query'] != '') {
    
    $page = $_GET['page']+1;

    $query = urlencode($_GET['query']);
    $a = curl('https://api.themoviedb.org/3/search/movie?api_key=408db82bcb709e53e2a0c72c20c6108b&language=zh-TW&query='.$query.'&page='.$page.'&include_adult=false');
    foreach ($a["results"] as $movie) {
        if ($movie["poster_path"]) {
            $html .= '<div class="gridViewItem" >
            <a href="moviePage.php?id='.$movie['id'].'">
                <img src="https://www.themoviedb.org/t/p/w220_and_h330_face/' . $movie["poster_path"] .'"alt=""> </a> </br>'.$movie['title'].'

            </div>';
        }

    }
    
    echo (json_encode(['result' => true, 'msg' => 'success', 'datas' => $html]));
    return;

} 

echo json_encode(['result' => false, 'msg' => '無輸入參數']);
die;

?>
