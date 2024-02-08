<?php
include("conn.php");
session_start();

?>
<?php
if (isset($_SESSION["user_email"])) {
    $user_login = $_SESSION["user_email"];
    $sql_get_data = "SELECT * FROM user_bebboo_tb WHERE email = '$user_login'";
    $result_get_data = $conn->query($sql_get_data);

    if ($result_get_data->num_rows > 0) {
        $row = $result_get_data->fetch_assoc();
        $email = $row['email'];
        $username = $row['username'];
        $tel = $row['tel'];
        $img = $row['avatar'];
    } else {
        echo "No data found for the user.";
    }
} else {
    echo "User not logged in.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lemon&display=swap" rel="stylesheet">
</head>
<style>
    body {
        background-color: #F3F8FF;
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        border-radius: 20px;
        border: 3px solid #99A3A4;
        margin: auto;
        background: rgb(255, 255, 255);
        width: 80%;
        max-width: 400px;
        margin-top: 50px;
        text-align: center;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    header img {
        width: 90%;
        height: auto;
        font-size: 40px;
        margin: 5px;
        border-radius: 10px;
    }

    .wrapper {
        padding: 20px;
    }

    .Input_box {
        position: relative;
        border-radius: 25px;
        margin: 15px;
    }

    .Input_box input {
        border-radius: 10px;
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
    }

    .buttot_sum {
        font-size: 20px;
        width: 100%;
        height: 35px;
        margin: 15px 0;
        border-radius: 10px;
        color: white;
        background-color: rgb(113, 234, 139);
        cursor: pointer;
    }

    .register {
        margin: 20px 0 0 0;
    }

    .register a {
        color: blue;
    }

    .error_text {
        color: white;
        background-color: #E74C3C;
        font-size: 15px;
        font-family: monospace;
        padding: 10px;
        border-radius: 10px;
    }

    .confirm_c {
        color: white;
        background-color: #2ECC71;
        font-size: 15px;
        font-family: monospace;
        padding: 10px;
        border-radius: 10px;
    }

    .avatar p {
        margin: 5px 0 0 0;
        font-size: 13px;
        text-align: left;
    }

    nav {
        background-color: black;
        padding: 10px;
    }

    .navbar {
        display: flex;
        justify-content: flex-end;
    }


    .navbar button {
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        border-radius: 5px;
        color: white;
        background-color: blue;
        font-size: 18px;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .navbar button:hover {
        background-color: #1a242f;
    }

    @media screen and (max-width: 600px) {
        .container {
            width: 90%;
        }

        header img {
            width: 80%;
        }

        .Input_box input {
            width: 100%;
        }

        .buttot_sum {
            width: 100%;
        }

        h1 {
            font-size: 24px;
        }
    }

    @media screen and (max-width: 400px) {
        .container {
            width: 95%;
        }

        header img {
            font-size: 20px;
        }

        .buttot_sum {
            font-size: 16px;
        }

        h1 {
            font-size: 20px;
        }
    }
</style>

<body>
    <nav>
        <div class="navbar">
            <a href="profile.php"><button>Go back</button></a>
        </div>
    </nav>
    <div class="container">
        <h1>Edit Profile</h1>
        <header><img src="<?php echo $img ?>" alt=""></header>
        <div class="wrapper">
            <?php if (isset($_SESSION['error_e'])) { ?>
                <h3 class="error_text">
                    <?php echo $_SESSION['error_e'];
                    unset($_SESSION['error_e']);
                    ?>
                </h3>
            <?php }
            ?>
            <?php if (isset($_SESSION['confirm_c'])) { ?>
                <h3 class="confirm_c">
                    <?php echo $_SESSION['confirm_c'];
                    unset($_SESSION['confirm_c']);
                    ?>
                </h3>
            <?php }
            ?>
            <form action="editprofile_pro.php" method="post" enctype="multipart/form-data">
                <h1><?php echo $email ?></h1>
                <div class="avatar">
                    <input type="file" name="file_img" />
                </div>
                <div class="Input_box">
                    <input name="Username" type="Text" placeholder="Yourname">
                </div>
                <div class="Input_box">
                    <input name="bio" type="Text" placeholder="bio" maxlength="100">
                </div>
                <div class="Input_box">
                    <input name="tel" type="Text" placeholder="Tel" maxlength="10">
                </div>
                <div class="Input_box">
                    <input name="Facebook" type="Text" placeholder="Facebook">
                </div>
                <div class="Input_box">
                    <input name="Line" type="Text" placeholder="Line">
                </div>
                <div class="Input_box">
                    <input name="pin" type="password" placeholder="pin" maxlength="5">
                </div>
                <div class="Input_box">
                    <input name="pin_con" type="password" placeholder="Confrim-Pin" maxlength="5">
                </div>
                <button class="buttot_sum" type="submit"> Confirm</button>
            </form>
        </div>
    </div>
</body>

</html>