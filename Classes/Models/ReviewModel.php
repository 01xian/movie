<?php
include("../../pub.php");

class ReviewModel
{
    public function review()
    {
        global $dbh;
        $sth = $dbh->prepare("SELECT * FROM review WHERE tmdb_id = '{$_GET['id']}'");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }
    
}