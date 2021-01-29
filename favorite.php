<?php
include("header.php");
?>
<h1 style="text-align:center" class="mt-4">My Movie List </h1>
<div class="row gridViewContainer justify-content-around mt-1">
<?php
$favoriteController = new FavoriteController();
$favoriteMovieHtml = $favoriteController->getFavoriteMovie();
echo ($favoriteMovieHtml);
?>
</div>
<?php include("footer.php");?>
