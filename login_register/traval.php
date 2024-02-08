<?php
include("conn.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stye/home.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>traval_content</title>
</head>

<body>
    <nav><?php include('navbar.php') ?></nav>
    <div class="container">
        <div class="row">
            <?php
            $travel = "travel";
            $sql = "SELECT * FROM ceate_tb WHERE cetegory= '$travel'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <div class="col-sm-9">
                    <div class="card">
                        <img src="<?php echo $row['cover_photo'] ?>" class="card-img-top" alt="">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $row['title'] ?></h3>
                            <p class="recapitulation"><?php echo $row['recapitulation'] ?></p>
                            <div class="user-date">
                                <p class="user"><?php echo $row['username'] ?></p>
                                <p class='date_'><?php echo $row['date_'] ?></p>
                            </div>
                            <p><?php echo $row['cetegory'] ?></p>
                            <a href="content.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>