<?php
include_once("header.php");
include_once("includeFiles.php");
?>
<script type="text/javascript">
    $(document).ready(function() {
        var valueToSearch = "<?php echo empty($_GET['valueToSearch'])?'' : $_GET['valueToSearch'];?>" ;
        showContent(valueToSearch, '即將上映', 'upcoming');
        var i = 0;
        $('#getMoreInfo').click(function(){
            i++;
            getMoreInfo(handleData, valueToSearch, i, $('.showInfo'));
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

<div class = "row gridViewContainer justify-content-around mt-1">

<div id="searchOrContent"></div>

<div class="searchResult"></div>
<div class="showInfo"></div>

<div class="d-grid pb-3 col-6 mx-auto">
<button class="btn btn-primary getMoreInfo btn1" style="display:none;" id="getMoreInfo" type="button">載入更多</button>
</div>

</div>
</div>
<?php include("footer.php")?>