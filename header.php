<?php
include("pub.php");
include("Classes/Controllers/SearchController.php");
include("Classes/Controllers/ＭovieController.php");
include("Classes/Controllers/FavoriteController.php");
include("Classes/Models/FavoriteMovieModel.php");
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
    <script src="https://kit.fontawesome.com/3deb95cfd6.js" crossorigin="anonymous"></script>
    <script src="js/common.js"></script>
    <script src="js/jquery.js"></script>
    <title>movie</title>
</head>
<body>
<?php include("nav.php")?>