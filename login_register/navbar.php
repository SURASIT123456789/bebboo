<?php

include("conn.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar with Search</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<style>
  a {
    color: white !important;
  }
</style>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-dark ">
    <div class="container-fluid">
      <a class="navbar-brand font-weight-bold mr-3 fw-bold fs-1" href="home.php">BEBBOO</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active fs-5" aria-current="page" href="profile.php">Profile</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fs-5" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Category
            </a>
            <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">

              <li><a class="dropdown-item" href="traval.php">Travel</a></li>
              <li><a class="dropdown-item" href="beauty.php">Beauty</a></li>
              <li><a class="dropdown-item" href="sport.php">Sport</a></li>
              <li><a class="dropdown-item" href="lifestyle.php">Lifestyle</a></li>

            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-5" href="create.php">Create</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-5" href="login.php">Logout</a>
          </li>
        </ul>

        <nav class="navbar bg-body-tertiary">
          <div action="home.php" class="container-fluid">
            <form method="post" class="d-flex" role="search">
              <input class="form-control me-2" type="text" id='search_id' autocomplete="off" placeholder="Search...">
              <button type="" class="btn btn-primary">search</button>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </nav>
  <div id="sechurl">

  </div>
  <script src="js/bootstrap.bundle.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(decument).ready(function() {
      $("#search_id").keyup(function() {
        var input = $(this).val();
        //alert(input);

        if (input != "") {
          $.ajax({
            url: "sech.php",
            method: 'POST',
            data: {
              input: input
            },
            success: function(data) {
              $("#sechurl").html(data);
            }
          });
        } else {
          $("#sechurl").css("display", "none");
        }
      })

    });
  </script>
</body>

</html>