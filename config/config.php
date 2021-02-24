<?php

define('API_KEY', '408db82bcb709e53e2a0c72c20c6108b');
define('MOVIE_API_URL', 'http://api.themoviedb.org/3/');
define('URL_KIND', [
    'UPCOMING' => 'movie/upcoming',
    'TOP_REATED' => 'movie/top_rated',
    'POPULAR' => 'movie/popular',
    'SEARCH' => 'search/movie',
    'MOVIE' => 'movie/', # 須在後頭加入對應的movie id ex: movie/1
    'CAST' => 'credits'# 須在前頭加入movie和對應的movie id ex: movie/1/credits
]);

define('LANGUAGE', 'zh-TW');
define('REGION', 'TW');
define('IMAGE_URL', 'https://www.themoviedb.org/t/p/');
define('IMAGE_SIZE', [
    'W220H330' => 'w220_and_h330_face',
    'W276H350'=>'w276_and_h350_face',
]);
