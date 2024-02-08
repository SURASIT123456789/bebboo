<?php
include("conn.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="stye/create.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg  bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="home.php">BEBBOO</a>
    </div>
  </nav>
  <div class="container">
    <form action="create_process.php" method="post" enctype="multipart/form-data">
      <header>Create</header>
      <?php if (isset($_SESSION['error_crete'])) { ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $_SESSION['error_crete'];
          unset($_SESSION['error_crete']); ?>
        </div>
      <?php }
      ?>
      <?php if (isset($_SESSION['success_create'])) { ?>
        <div class="alert alert-success" role="alert">
          <?php echo $_SESSION['success_create'];
          unset($_SESSION['success_create']); ?>
        </div>
      <?php }
      ?>
      <div class="form-check">
        <div class="img">
          <div class="Img_bar">
            <label for="file_imgcover" class="form-label">Cover photo</label>
            <input type="file" class="form-control" id="file_imgcover" name="file_imgcover" />
          </div>
          <div class="Img_bar">
            <label for="file_img1" class="form-label">Insert a picture</label>
            <input type="file" class="form-control" id="file_img1" name="file_img1" />
          </div>
          <div class="Img_bar">
            <label for="file_img2" class="form-label">Insert a picture</label>
            <input type="file" class="form-control" id="file_img2" name="file_img2" />
          </div>
          <div class="Img_bar">
            <label for="file_img3" class="form-label">Insert a picture</label>
            <input type="file" class="form-control" id="file_img3" name="file_img3" />
          </div>
        </div>
        <div class="choose_">
          <p>Choose Category</p>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="choose" id="Check_choose1" value="travel">
            <label class="form-check-label" for="Check_choose1">Travel</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="choose" id="Check_choose2" value="Beauty">
            <label class="form-check-label" for="Check_choose2">Beauty</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="choose" id="Check_choose3" value="sport">
            <label class="form-check-label" for="Check_choose3">Sport</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="choose" id="Check_choose4" value="lifestyle">
            <label class="form-check-label" for="Check_choose4">Lifestyle</label>
          </div>
        </div>
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
          <label for="recap" class="form-label">Recapitulation</label>
          <input type="text" class="form-control" id="recap" name="recap">
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <textarea class="form-control" id="content" name="content" rows="8" style="resize: vertical;"></textarea>
        </div>
        <button class="btn btn-primary" type="submit"> Confirm</button>
      </div>
    </form>
  </div>
</body>

</html>