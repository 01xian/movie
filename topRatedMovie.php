<?php
include("header.php");
?>
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
if (isset($_GET['valueToSearch']) && $_GET['valueToSearch'] != '') {
    include("search.php");

} else {
    $movieController = new MovieController();
    $html = $movieController->top20Gridview('最高評分電影', 'top_rated');
    echo ($html);
}
?>
</div>
</div>
<?php include("footer.php")?>