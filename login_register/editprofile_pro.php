<?php
include("conn.php");
session_start();

if (isset($_POST["Username"]) && isset($_POST["tel"]) && isset($_POST["pin"]) && isset($_POST["pin_con"]) && isset($_POST["Facebook"]) && isset($_POST["Line"]) && isset($_POST["bio"])) {

    $email = $_SESSION["user_email"];
    $username = mysqli_real_escape_string($conn, $_POST["Username"]);
    $facebook = mysqli_real_escape_string($conn, $_POST["Facebook"]);
    $line = mysqli_real_escape_string($conn, $_POST["Line"]);
    $bio = mysqli_real_escape_string($conn, $_POST["bio"]);
    $pin = mysqli_real_escape_string($conn, $_POST["pin"]);
    $tel = mysqli_real_escape_string($conn, $_POST["tel"]);
    $pin_con = mysqli_real_escape_string($conn, $_POST["pin_con"]);

    $filemp = $_FILES['file_img']['tmp_name'];
    $filename = $_FILES['file_img']['name'];
    $filepath = 'img/' . $filename;

    if (empty($username)) {
        $result = $conn->query("SELECT username FROM user_bebboo_tb WHERE email = '$email'");
        $row = $result->fetch_assoc();
        $username = $row['username'];
    }

    if (empty($facebook)) {
        $result = $conn->query("SELECT facebook FROM user_bebboo_tb WHERE email = '$email'");
        $row = $result->fetch_assoc();
        $facebook = $row['facebook'];
    }

    if (empty($bio)) {
        $result = $conn->query("SELECT bio FROM user_bebboo_tb WHERE email = '$email'");
        $row = $result->fetch_assoc();
        $bio = $row['bio'];
    }

    if (empty($line)) {
        $result = $conn->query("SELECT line_ FROM user_bebboo_tb WHERE email = '$email'");
        $row = $result->fetch_assoc();
        $line = $row['line_'];
    }

    if (empty($pin)) {
        $result = $conn->query("SELECT pin FROM user_bebboo_tb WHERE email = '$email'");
        $row = $result->fetch_assoc();
        $pin = $row['pin'];
    } elseif (strlen($pin) != 5) {
        $_SESSION["error_e"] = "There must be 5 pins.";
        header('Location:editprofile.php');
        exit();
    } elseif ($pin != $pin_con) {
        $_SESSION['error_e'] = "Passwords don't match";
        header('Location:editprofile.php');
        exit();
    }

    if (empty($tel)) {
        $result = $conn->query("SELECT tel FROM user_bebboo_tb WHERE email = '$email'");
        $row = $result->fetch_assoc();
        $tel = $row['tel'];
    } elseif (strlen($tel) != 10) {
        $_SESSION["error_e"] = "Phone number must have 10 digits.";
        header('Location:editprofile.php');
        exit();
    }

    if (is_uploaded_file($filemp)) {
        $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if ($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
            $_SESSION["error_e"] = "Sorry, only PNG, JPG, and JPEG files are allowed.";
            header('Location:editprofile.php');
            exit();
        }

        $filesize = $_FILES['file_img']['size'];
        if ($filesize > 5000000) {
            $_SESSION["error_e"] = "Sorry, your file is too large. Maximum file size is 5 MB.";
            header('Location:editprofile.php');
            exit();
        }

        move_uploaded_file($filemp, $filepath);
    } else {
        $result = $conn->query("SELECT avatar FROM user_bebboo_tb WHERE email = '$email'");
        $row = $result->fetch_assoc();
        $filepath = $row['avatar'];
    }

    $update_query = "UPDATE user_bebboo_tb SET avatar = '$filepath', username ='$username', pin='$pin', tel='$tel', line_='$line', facebook='$facebook', bio='$bio' WHERE email = '$email'";

    if ($conn->query($update_query) === TRUE) {
        $_SESSION["confirm_c"] = "Change completed.";
        header('Location:editprofile.php');
        exit();
    } else {
        $_SESSION["error_text"] = "Error updating record: " . mysqli_error($conn);
        header('Location:editprofile.php');
        exit();
    }
} else {
    header('Location:editprofile.php');
    exit();
}
?>
