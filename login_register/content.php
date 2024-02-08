<?php
include("conn.php");
session_start();
$id = $_GET["id"];
$sql_get_data = "SELECT * FROM ceate_tb WHERE id = '$id'";
$result_get_data = $conn->query($sql_get_data);
if ($result_get_data->num_rows > 0) {
    $row = $result_get_data->fetch_assoc();
    $email = $row['email'];
    $username = $row['username'];
    $img1 = $row['img1'];
    $img2 = $row['img2'];
    $img3 = $row['img3'];
    $cetegory = $row['cetegory'];
    $date = $row['date_'];
    $title = $row['title'];
    $content = $row['content'];
} else {
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>content</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    .container-fluid a {
        margin: 10px;
        font-size: 30px;
        font-weight: 600;
    }

    .container {
        border-radius: 15px;
        margin: 50px auto;
    }

    img {
        border: 3px solid #ECF0F1;
        width: 400px;
        height: 400px;
    }

    .title {
        font-weight: 800;
        font-weight: 100%;
        border-radius: 5px;
        margin: 50px;

        text-align: center;
        font-size: 50px;
        color: white;

    }

    .container-contern {
        border-radius: 15px;
        height: 100%;

        color: white;
        margin: 50px;


    }

    .conteiner_com {
        border: 2px solid black;
        margin: auto;
        background-color: white;
        height: 100%;
        width: 70%;
    }

    .Com-text {
        margin: 5px;
        background-color: white;
    }

    .Com-text p {
        color: black;
        font-weight: 900;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        font-size: 50px;
        text-align: center
    }

    .Com_user {
        width: 350px;
        background-color: white;
        margin: 20px;
        display: flex;
        align-items: center;
    }

    .Com_user img {
        width: 50px;
        height: 50px;
        border-radius: 100%;
    }

    .Com_user h3 {
        margin: 0 0 0 10px;
        font-size: 25px;
    }

    .Com_user p {
        margin: 0 0 0 20px;
        font-size: 10px;
    }

    .come_user_text {
        margin: 0 0 0 110px;
    }

    .come_user_text p {
        max-width: 50%;
        word-wrap: break-word;
    }

    .input_text {

        margin: 30px;
        display: flex;
        align-items: center;
    }

    .input_text button {
        color: #FBFCFC;
        font-weight: 500;
        margin: 0 0 0 10px;
        height: 30px;
        width: 100px;
        background-color: #3498DB;
    }

    .custom-bg {
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        border: 3px solid #B3B6B7;
        text-align: center;
        background-color: #000000;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg  bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand " style="color: aliceblue;" href="home.php">BEBBOO</a>
        </div>
    </nav>
    <div class="container  custom-bg">
        <p class="title"><?php echo $title ?></p>
        <img class="me-3" src="<?php echo $img1 ?>" alt="">
        <img class="me-3" src="<?php echo $img2 ?>" alt="">
        <img class="me-3" src="<?php echo $img3 ?>" alt="">
        <div class="container-contern">
            <section class="">
                <p class="lead text-center fs-5   "><?php echo $content ?>
                </p>
            </section>
        </div>
        <div class="conteiner me-1  text-end text-light">
            <h3>Creator</h3>
            <p><?php echo $username ?></p>
            <p class="fw-lighter">date :<?php echo $date ?></p>
        </div>
    </div>
    <div class="conteiner_com">
        <div class="Com-text">
            <p>Comment</p>
        </div>
        <?php
        $sql_1 = "SELECT * FROM comment_tb WHERE post_id='$id' ORDER BY date_ ASC";
        $result_1 = mysqli_query($conn, $sql_1);
        while ($row_1 = mysqli_fetch_array($result_1)) {
        ?>
            <div class="col">
                <div class="Com_user">
                    <img src="<?php echo $row_1['avartar'] ?>" alt="">
                    <h3><?php echo $row_1['username'] ?> </h3>
                    <p><?php echo $row_1['date_'] ?></p>
                </div>
                <div class="come_user_text">
                    <p><?php echo $row_1['commen'] ?></p>
                </div>
            </div>
        <?php
        }
        ?>

        <form action="comment_process.php" method="post">
            <div class="input_text">
                <textarea name="comment" rows="4" style="resize: vertical; width: 50%;"></textarea>
                <input type='hidden' name='id' value='<?php echo $id; ?>'>
                <button type='submit'>Confirm</button>
        </form>
    </div>

    </div>


</body>

</html>