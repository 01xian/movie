
<?php
$dbh = new PDO('mysql:host=localhost;dbname=movie;charset=utf8', 'root', 'root');

session_start();

function curl($url) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $output = curl_exec($ch);
    $result = json_decode($output, true);
    curl_close($ch);
    return $result;
}

function check_login($email , $password) {
    
    global $dbh;
    $sth = $dbh->prepare("SELECT * FROM member WHERE email = ? AND password = ? ");
    $field = [
        $email, md5($password)
    ];
    $sth->execute($field);
    $result = $sth->fetch();
    return ($result);
}

function login($result) {
    $_SESSION['is_login'] = 'yes';
    $_SESSION['member_data'] = json_encode($result);
}

function add_to_favourtite($tmdb_id) {

    if (isset($_SESSION['is_login']) && $_SESSION['is_login'] == 'yes') {

        $member_data = json_decode($_SESSION['member_data']);
        $member_id = $member_data->id;
        global $dbh;
        $sth = $dbh->prepare('SELECT * FROM favorite_movie WHERE member_id = ? AND tmdb_id = ?');
        $field = [$member_id, $tmdb_id];
        $sth->execute($field);
    
        return ($sth->fetch());
    } else {
        return false;
    }
 
}

$datetime = new \DateTime;
$datetime = $datetime->format('Y-m-d H:i:s');