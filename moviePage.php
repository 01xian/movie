
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
    <script src="js/script.js"></script>
    <script src="js/jquery.js"></script>
    <script src="https://kit.fontawesome.com/3deb95cfd6.js" crossorigin="anonymous"></script>

    <title>movie</title>

</head>
<body>
<script>
$(document).ready(function () {
    $("#reviewBtn").click(function(){
        if($("#review").val() != '') {
            $.ajax({
                type: "POST",
                url: "ajax/add_review.php",
                data:{
                    'member_id' : $("#member_id").val(),
                    'name' : $("#name").val(),
                    'review' : $("#review").val(),
                    'tmdb_id' : $("#tmdb_id").val()
                },
                datatype: 'json',
                success:function(response){
                    var response = JSON.parse(response);
                    console.log('1113');
                    alert(response.msg);
                    location.reload();

                    if (response.result) {
                        $("#review").val('');
                    }
                },
                error:function(thrownError){
                    console.log(thrownError);
                }
            });
        } else {
            alert('請填影評');
        }
        
    });

    $('#add_favorite').click(function(){
        $.ajax({
            type:"POST",
            url:"ajax/add_favorite.php",
            data:{
                'tmdb_id':$("#tmdb_id").val(),
                'poster_path':$("#poster_path").val(),
                'overview':$("#overview").text(),
                'title': $("#title").text()
            },
            success:function(response){
                console.log(response);
                if (response) {
                    alert(response);
                    location.reload();
                }
            },
            error:function(thrownError){
                console.log(thrownError);
            }
        });

    });

    $('#remove_favorite').click(function(){
        $.ajax({
            type:"POST",
            url:"ajax/remove_favorite.php",
            data:{
                'tmdb_id':$("#tmdb_id").val(),
            },
            success:function(response){
                console.log(response);
                if (response) {
                    alert(response);
                    location.reload();
                }
            },
            error:function(thrownError){
                console.log(thrownError);
            }
        });

    });
    
});


</script>
<?php include("nav.php")?>
<?php
$movie = curl("https://api.themoviedb.org/3/movie/".$_GET['id']."?api_key=408db82bcb709e53e2a0c72c20c6108b&language=zh-TW");
$movieCast = curl("https://api.themoviedb.org/3/movie/".$_GET['id']."/credits?api_key=408db82bcb709e53e2a0c72c20c6108b&language=zh-TW");

echo ('<div class="movieContainer mt-5 row m-auto">
           <div class="moviePoster m-2 col-12 col-md-5"> 
               <img src="https://www.themoviedb.org/t/p/w1280/'.$movie["poster_path"].'" alt="">
           </div>
           <div class="movieContent m-1 col-12  col-md-6">
               <h1 class="mt-2" id="title">'.$movie["title"].'</h1>
               <p>'.$movie["release_date"].'</p>
              ');
        $movieGenre = [];
        foreach ($movie["genres"] as $genre) {
            $movieGenre[] = $genre["name"];
        }
        echo (implode('、', $movieGenre ));

        if (add_to_favourtite($_GET['id']))
        {
            echo('<h2><button type="button" id="remove_favorite" class="btn  mt-3 btn-block btn-outline-secondary " ><span class="far fa-window-close fa-lg"></span> 從我的清單中刪除</button></h2>');
        } else {
            echo('<h2><button type="button" id="add_favorite" class="btn  mt-3 btn-block btn-outline-danger " ><span class="far fa-kiss-wink-heart fa-lg"></span>加入我的清單</button></h2>');
        }
        echo(
            '<input type="hidden"  id="poster_path" value="'.$movie["poster_path"].'">
            <h3 class="mt-4"> 劇情  </h3>
            <p id="overview">'.$movie["overview"].'</p>
            </div>
        </div>
        <div class="cast mt-3 m-auto " >
            <h3 class="m-1 mb-4">主要演員</h3>
            <div class="castContainer row">');
        foreach ($movieCast["cast"] as $key => $cast) {
            if ($key > 7) continue;
            echo ('<div class="castDetail m-auto ">
                       <img src="https://www.themoviedb.org/t/p/w276_and_h350_face/'.$cast["profile_path"].'" alt="">
                       <span>'.$cast["name"].'</span> </br>
                       <span>'.$cast["character"].'</span>
                   </div>'
                );
        }
        echo ('</div> </div>');
//        echo('這電影的id是'.$_GET['id']);
 //var_dump($movie);

//Get Translations
//Get Credits
//https://www.themoviedb.org/t/p/w1280/vWYpsSMMuMzFKAd7QmX5xwvM4dw.jpg
//Get Videos
?>


<div class="message  mt-5">
    <div class="message card  mb-3 border-secondary " >
    <div class="card-header" style="background-color: #47818680; color:white;">心得影評</div>
    <div class="card-body text-secondary" style="background-color: #ece3e39c;"> 

        <h5 class="card-title">
        <?php
            if (isset($_SESSION['is_login']) && $_SESSION['is_login'] == 'yes') {
                $memberData = json_decode($_SESSION['member_data']);
                echo ('作者：'.$memberData->name);
            } else {
            ?>
                請先 <a href="login.php">登入</a> 哦！
            <?php
            }
            ?>
        </h5>
        <p class="card-text">
        <form>
            <div class="form-group">
                <textarea class="form-control border-secondary " id="review" rows="3"></textarea>
            </div>
            <input type="hidden"  id="member_id" value="<?php echo $memberData->id?>">
            <input type="hidden"  id="name" value="<?php echo $memberData->name?>">
            <input type="hidden"  id="tmdb_id" value="<?php echo $_GET['id']?>">


            <button type="button" class="btn btn-secondary mt-3" id="reviewBtn">送出</button>
        </form>
        </p>
    </div>
    </div>
</div>

<?php
$sth = $dbh->prepare("SELECT * FROM review WHERE tmdb_id = '{$_GET['id']}'");
$sth->execute();
$result = $sth->fetchAll();
foreach ($result as $value) {
    
    echo ('<div class="review">
    <div class="card mt-3 border-success ">
    <div class="card-header border-success " style="background-color: #47818680; color:white;">作者：'.
    $value['name']
    .'</div>
    <div class="card-body text-secondary">
      <blockquote class="blockquote mb-0">
        <p>'.$value['review']
        .'</p>
      </blockquote>
    </div>
  </div>
  </div>');
}

?>
 
</body>
</html>

