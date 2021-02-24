<?php
include_once dirname(__DIR__).("/includeFiles.php");
    if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == 'yes') {
        echo('
        <a class="nav-link" href="favorite.php">我的清單</a>
        <a class="nav-link" href="logout.php">登出</a>');  
    } else {
        echo('<a class="nav-link" href="login.php">登入</a>');
    }
