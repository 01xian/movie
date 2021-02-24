
<?php
include_once("header.php");
include_once("includeFiles.php");
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = $_GET['id'];
} else {
    header("location:index.php");
}
?>
<script>
$(document).ready(function () {
    $("#reviewBtn").click(function(){
        reviewBtn($("#review"), $("#member_id"), $("#name"), id);       
    });    
});
    var id = "<?php echo $id;?>";
    checkwriter(id);
    showReview(id);
    //moviepageIntro(id, $(".movieIntr"), $('#addFavorite'), id, $("#poster_path"), $("#overview"), $("#title"), $('#removeFavorite') );
    $.ajax({
        type:"POST",
        url:"ajax/movieIntro.php",
        data:{
            'id':id
        },
        success: function(response){
            $(".movieIntr").html(response);
            $('#addFavorite').click(function(){
            addFavorite(id, $("#poster_path"), $("#overview"), $("#title"));
            });

            $('#removeFavorite').click(function(){
                revomeFavorite(id);
            });
        }
    });
</script>
<?php
// $moviePage = new MoviepageController();
// $html = $moviePage->movieIntr($_GET['id']);
// echo ($html);
?>
<div class="movieIntr"></div>
<div class="message  mt-5">
    <div class="message card  mb-3 border-secondary " >
    <div class="card-header" style="background-color: #47818680; color:white;">心得影評</div>
    <div class="card-body text-secondary" style="background-color: #ece3e39c;">
        <h5 class="card-title">
        <div class="writer"></div>
        </h5>
        <p class="card-text">
        <form>
            <div class="form-group">
                <textarea class="form-control border-secondary " id="review" rows="3"></textarea>
            </div>
            <input type="hidden"  id="member_id">
            <input type="hidden"  id="name">
            <input type="hidden"  id="tmdb_id">
            <button type="button" class="btn btn-secondary mt-3" id="reviewBtn">送出</button>
        </form>
        </p>
    </div>
    </div>
</div>
<div class="showReview"></div>
<?php
include("footer.php");
?>

