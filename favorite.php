<?php
include("pub.php");
include("Classes/Controllers/FavoriteController.php");
include("Classes/Models/FavoriteMovieModel.php");
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
<script type="text/javascript">
    $(document).ready(function() {

    });  
</script>
<?php include("nav.php")?>
<h1 style="text-align:center" class="mt-4">My Movie List </h1>
<div class="row gridViewContainer justify-content-around mt-1">
<?php
$favoriteController = new FavoriteController();
$favoriteMovieHtml = $favoriteController->getFavoriteMovie();
echo ($favoriteMovieHtml);
?>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script> 

</body>
</html>
