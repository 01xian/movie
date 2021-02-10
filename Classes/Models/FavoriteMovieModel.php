<?php
include_once ("DBConnect.php");
class FavoriteMovieModel extends DBConnect
{
    public function getFavoriteMovie($member_id) 
    {  
        $sth = $this->dbConnect->prepare('SELECT * FROM favorite_movie WHERE member_id = ? ');
        $sth->execute(array($member_id));
        $result = $sth->fetchAll();

        return json_encode($result);
    }

    public function addFavoriteMovie($memberId, $tmdbId, $title, $posterPath, $overview) 
    {  
        $sth = $this->dbConnect->prepare('INSERT favorite_movie (member_id, tmdb_id, title, poster_path, overview, created_at, updated_at)
        VALUES (:member_id, :tmdb_id, :title, :poster_path, :overview, :created_at, :updated_at)');
        $field = [
            ':member_id' => $memberId,
            ':tmdb_id' => $tmdbId,
            ':title' => $title,
            ':poster_path' => $posterPath,
            ':overview' => $overview,
            ':created_at' => date('Y-m-d H:i:s'), 
            ':updated_at' => date('Y-m-d H:i:s')
        ];

        return ($sth->execute($field));
    }

    public function deleteFavoriteMovie($tmdbId) 
    {  
        $sth = $this->dbConnect->prepare('DELETE FROM favorite_movie WHERE tmdb_id = ? ');
        return ($sth->execute(array($tmdbId)));
    }

    function checkFavourtite($tmdb_id){

        if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == 'yes') {
    
            $member_data = json_decode($_SESSION['member_data']);
            $member_id = $member_data->id;
            $sth = $this->dbConnect->prepare('SELECT * FROM favorite_movie WHERE member_id = ? AND tmdb_id = ?');
            $field = [$member_id, $tmdb_id];
            $sth->execute($field);
        
            return ($sth->fetch());
        } else {
            return false;
        }
    }
}