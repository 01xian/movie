<?php
include("../../pub.php");

class FavoriteMovieModel 
{
    public function getFavoriteMovie($member_id) 
    {
        global $dbh;
        $sth = $dbh->prepare('SELECT * FROM favorite_movie WHERE member_id = ? ');
        $sth->execute(array($member_id));
        $result = $sth->fetchAll();

        return json_encode($result);
    }
}