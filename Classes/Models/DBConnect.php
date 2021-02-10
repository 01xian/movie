<?php
class DBConnect 
{
    public $dbConnect;

    public function __construct()
    {
        $this->dbConnect = new PDO('mysql:host=localhost;dbname=movie;charset=utf8', 'root', 'root');
    }
}