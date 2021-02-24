<?php
include_once("header.php");
include_once("includeFiles.php");
?>
<script>
$(document).ready(function(){
    showFavoriteMovie();
});
</script>
<h1 style="text-align:center" class="mt-4">My Movie List </h1>
<div class="row gridViewContainer justify-content-around mt-1">
<div id="favouriteMovie"></div>
</div>
<?php include("footer.php");?>
