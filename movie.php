<?php
include("pub.php");
include("Classes/Controllers/SearchController.php");
include("Classes/Controllers/ＭovieController.php");
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
<?php include("nav.php")?>

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
        $indexController = new SearchController();
        $indexSearchHtml = $indexController->search($_GET['valueToSearch']);
        echo($indexSearchHtml);
?>
    <div class="showInfo"></div>
    <div class="d-grid pb-3 col-6 mx-auto">
    <button class="btn btn-primary getMoreInfo btn1" type="button">載入更多</button>
    <div class="query" style="display:none"><?php echo ($query); ?></div>
    </div>

<?php
} else {
    $movieController = new MovieController();
    $html = $movieController->top20Gridview('熱門電影 Top20', 'popular');
    echo ($html);
}
?>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>
