<?php
include("pub.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/common.js"></script>
    <script src="js/jquery.js"></script>

    <title>movie</title>

</head>
<body>
<script type="text/javascript">
$(document).ready(function() {
    var i = 0;
    $('#getMoreInfo').click(function(){
        i++;
        var query = <?php echo json_encode($_GET['valueToSearch']) ?>;
        getMoreInfo(handleData, query, i, $('.showInfo'));
    });
});   
</script>
<?php include("nav.php")?>
    <div class = "banner">
        <img src="img/banner.jpg" alt="">   
        <div class="searchContainer m-auto">
            <form> 
                <input type="text"  class = "searchInput col-12 col-md-9" name = "valueToSearch">
                <input type="submit" class = "searchBut col-12 col-md-2 mt-1" value = "搜尋">
            </form> 
        </div>
    </div>

<div class = " row  gridViewContainer justify-content-around mt-1 ">
<?php
if ($_GET['valueToSearch']) {
    echo ('<h3>搜尋"'.$_GET['valueToSearch'].'"結果</h3>');
    $query = urlencode($_GET['valueToSearch']);
    $a = curl('https://api.themoviedb.org/3/search/movie?api_key=408db82bcb709e53e2a0c72c20c6108b&language=zh-TW&query='.$query.'&page=1&include_adult=false');
    foreach ($a["results"] as $movie) {
        if ($movie["poster_path"]) {
            echo '<div class="gridViewItem" >
            <a href="moviePage.php?id='.$movie['id'].'">
            <img src="https://www.themoviedb.org/t/p/w220_and_h330_face/' . $movie["poster_path"] .'"alt=""> </a> </br>'.$movie['title'].
            '</div>';
        }
      
    }
?>
    <div class="showInfo"></div>
    <div class="d-grid pb-3 col-6 mx-auto">
    <button class="btn btn-primary getMoreInfo btn1" type="button">載入更多</button>
    <div class="query" style="display:none"><?php echo ($query); ?></div>
    </div>


<?php
} else {
    echo ('<h2 class="mb-3" >熱門電影 Top20</h2>');
    $movieTop20Id = []; 
    $a = curl('http://api.themoviedb.org/3/movie/popular?api_key=408db82bcb709e53e2a0c72c20c6108b&language=zh-TW');
    foreach ($a["results"] as $key => $movie) {
        echo '<div class="gridViewItem" >
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
}
?>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>
