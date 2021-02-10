
<?php
session_start();

function curl($url){

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $output = curl_exec($ch);
    $result = json_decode($output, true);
    curl_close($ch);
    
    return $result;
}

function login($result){
    $_SESSION['isLogin'] = 'yes';
    $_SESSION['member_data'] = json_encode($result);
}