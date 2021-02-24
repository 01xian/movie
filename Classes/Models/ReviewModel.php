<?php
include_once ("DBConnect.php");
include_once dirname(__DIR__, 2).("/pub.php");

class ReviewModel extends DBConnect
{
    public function showReview($id)
    {
        $sth = $this->dbConnect->prepare("SELECT * FROM review WHERE tmdb_id = '{$id}'");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    public function addReview($tmdbId, $memberId, $name, $review)
    {
        $sth = $this->dbConnect->prepare('INSERT review (tmdb_id, member_id, name, review) 
                      VALUES (:tmdb_id, :member_id, :name, :review)');
        $field = [
            ':tmdb_id' => $tmdbId, 
            ':member_id' => $memberId, 
            ':name' => $name, 
            ':review' => $review
        ];
        
        return ($sth->execute($field));
    }
}