<?php
include_once("includeFiles.php");
?>
<script>
navCheckLogin();
</script>
<nav class="navbar navbar-expand-lg  navbar navbar-dark  " style="background-color: #d81b0163;">
  <div class="container-fluid ">
    <a class="navbar-brand" href="index.php">Movie</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavAltMarkup">
      <div class="navbar-nav ">
        <a class="nav-link active" aria-current="page" href="movie.php">熱門Top20</a>
        <a class="nav-link" href="topRatedMovie.php">最高評分</a>
        <a class="nav-link" href="upcomingMovie.php">即將上映</a>
        <a class="nav-link" href="nowPlayingMovie.php">上映中</a>
      </div>
    </div>
  </div>
</nav>