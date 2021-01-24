<?php
include("pub.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/script.js"></script>
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
if (isset($_SESSION['is_login']) && $_SESSION['is_login'] == 'yes') {
  $member_data = json_decode($_SESSION['member_data']);
  $member_id = $member_data->id;
  $sth = $dbh->prepare('SELECT * FROM favorite_movie WHERE member_id = ? ');
  $sth->execute(array($member_id));
  $result = $sth->fetchAll();
  foreach ($result as $key=>$value) {
    echo '<div class="gridViewItem mt-3 " >
    <a href="moviePage.php?id='.$value['tmdb_id'].'">
    <img src="https://www.themoviedb.org/t/p/w220_and_h330_face/' . $value["poster_path"] .'"alt=""> </a> 
    '.$value['title'].' 
</div>';
  }

} else {
  echo('<div><h2>請先<a href="login.php">登入</a>!</h2></div>');
}
?>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script> 

</body>
</html>
