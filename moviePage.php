
<?php
include("pub.php");
include("Classes/Controllers/MoviepageController.php");
include("Classes/Models/ReviewModel.php");
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
    <script src="https://kit.fontawesome.com/3deb95cfd6.js" crossorigin="anonymous"></script>

    <title>movie</title>

</head>
<body>
<script>
$(document).ready(function () {
    $("#reviewBtn").click(function(){
        reviewBtn($("#review"), $("#member_id"), $("#name"), $("#tmdb_id"));       
    });

    $('#add_favorite').click(function(){
        addFavorite($("#tmdb_id"), $("#poster_path"), $("#overview"), $("#title"));
    });

    $('#remove_favorite').click(function(){
        revomeFavorite($("#tmdb_id"));
    });
    
});
</script>
<?php include("nav.php")?>
<?php
$moviePage = new MoviepageController();
$html = $moviePage->movieIntr($_GET['id']);
echo ($html);
?>
<div class="message  mt-5">
    <div class="message card  mb-3 border-secondary " >
    <div class="card-header" style="background-color: #47818680; color:white;">心得影評</div>
    <div class="card-body text-secondary" style="background-color: #ece3e39c;">
        <h5 class="card-title">
        <?php
        $writer = $moviePage->writer($_GET['id']);
        $memberData = json_decode($_SESSION['member_data']);
        echo ($writer); 
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
$html = $moviePage->showReview();
echo ($html);
?>
 
</body>
</html>

