<?php
include_once dirname(__DIR__).("/includeFiles.php");
$favoriteController = new FavoriteController();
$favoriteMovieHtml = $favoriteController->getFavoriteMovie();
echo $favoriteMovieHtml;