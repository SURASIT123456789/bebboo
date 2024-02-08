<?php
include("conn.php");
session_start();
?>
<?php
$email = $_SESSION["user_email"];
$sql_get_data = "SELECT * FROM user_bebboo_tb WHERE email='$email'";
$result_get_data = $conn->query($sql_get_data);
if ($result_get_data->num_rows > 0) {
  $row = $result_get_data->fetch_assoc();
  $username = $row['username'];
  $avatar = $row['avatar'];
  $tel = $row['tel'];
  $line = $row['line_'];
  $facebook = $row['facebook'];
  $bio=$row['bio'];
} else {
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <link rel="stylesheet" href="stye/.css">
  <link rel="stylesheet" href="css/lightbox.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
</head>

<body>

  <style>
    body {
      background-color: #F3F8FF;
      margin: 0;
      padding: 0;
    }

    .navbar {
      background-color: #343a40;
    }

    .navbar-brand {
      color: aliceblue !important;
    }

    .container.profile-container {
      border: 2px solid #7F8C8D;
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .profile-picture {
      width: 250px;
      height: 250px;
      border-radius: 50%;
      margin: 0 auto 20px;
      overflow: hidden;
    }

    .profile-picture img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .profile-info {
      font-size: 20px;
      text-align: center;
    }

    .profile-info p {
      color: #495057;
    }

    .User_name {
      font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
      font-size: 5vh;
      font-weight: 900;
      color: black;
      text-align: center;
    }

    .buttom_edit {
      text-align: center;
    }

    .buttom_edit button {
      color: white;
      width: 100%;
      font-size: 20px;
      background-color: #239B56;
      border-radius: 10px;
    }


    .card {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      max-width: 100%;
      margin: auto 10px;
      text-align: center;
    }

    .container.profile-container {
      max-width: 400px;
    }

    .profile-info {
      word-wrap: break-word;
    }

    .card img {
      height: 200px;
      object-fit: cover;
    }

    .col-md-5 {
      margin: 20px;
    }
    .bio p{
      width:100% ;
      height: 100%;
     font-size: 15px;

    }
  </style>
  <div class="conteiner main_con">
    <nav class="navbar navbar-expand-lg  bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand " style="color: aliceblue;" href="home.php">BEBBOO</a>
      </div>
    </nav>
    <div class="container profile-container">
      <div class="User_name ">
        <p><?= $username ?></p>
      </div>
      <div class="profile-picture">
        <img src="<?php echo $avatar ?>" alt="Profile Picture">
      </div>
      <div class="bio">
      </div>
      <div class="profile-info">
        <div class="bio">
          <p><?php echo $bio ?></p>
        </div>
        <br>
        <p> <b>Facebook</b> :<?= $facebook ?></p>
        <p><b>Line</b>: <?= $line ?></p>
        <p><b>Email</b>:<?= $email ?></p>
      </div>
      <br>
      <div class="buttom_edit">
        <a href="editprofile.php"><button type="submit"> Edit Profile</button></a>
      </div>
    </div>
  </div>


  <<?php
    $sql_get_data = "SELECT * FROM ceate_tb WHERE email='$email'";
    $result_get_data = $conn->query($sql_get_data);
    ?> <div class="container mt-5">
    <h2>Your posts</h2>
    <div class="row">
      <?php
      while ($row = $result_get_data->fetch_assoc()) {
        $id = $row['id'];
        $date = $row['date_'];
        $username = $row['username'];
        $cover_img = $row['cover_photo'];
        $title = $row['title'];
        $recapitulation = $row['recapitulation'];
      ?>
        <div class="col-md-5">
          <div class="card">
            <img src="<?php echo $cover_img; ?>" class="card-img-top" alt="">
            <div class="card-body">
              <h1 class="card-title"><?php echo $title; ?></h1>
              <p class="card-text"><?php echo $recapitulation; ?></p>
              <p class="card-text"><small class="text-muted"><?php echo $date; ?></small></p>
              <a href="content.php?id=<?php echo $id; ?>" class="btn btn-primary">View Post</a>
              <a href="editpost.php?id=<?php echo $id; ?>" class="btn btn-warning">Edit Post</a>
              <a href="#" onclick="confirmDelete(<?php echo $id; ?>);" class="btn btn-danger">Delete</a>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Will you delete this post',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: ' delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'delete_post.php?id=' + id;
                }
            });
        }
    </script>
    <script src="js/lightbox.min.js"></script>
</body>

</html>