<?php
include_once ("DBConnect.php");
class MovieModel extends DBConnect
{
    public function movie($top20Ids)
    {
        $sth = $this->dbConnect->prepare('SELECT * FROM movie WHERE tmdb_id IN ('.$top20Ids.') ');
        $sth->execute();
        return($sth->fetchAll());
    }

    public function insertMovie($id, $title, $posterPath, $genres, $releaseDate, $overview, $cast)
    {
        $sth = $this->dbConnect->prepare('INSERT movie (tmdb_id, name, poster_path, genre, release_date, overview, cast_poster_path, created_at, updated_at) VALUES (:tmdb_id, :name, :poster_path, :genre, :release_date, :overview, :cast_poster_path, :created_at, :updated_at)');
        $field = [
            ':tmdb_id' => $id, 
            ':name' => $title, 
            ':poster_path' => $posterPath, 
            ':genre' => json_encode($genres), 
            ':release_date' => $releaseDate, 
            ':overview' => $overview, 
            ':cast_poster_path' => json_encode($cast), 
            ':created_at' => date('Y-m-d H:i:s'), 
            ':updated_at' => date('Y-m-d H:i:s')
        ];
       
        $sth->execute( $field );
    }
}
?>