<?php
include("conn.php");

session_start();

if (
    isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["con-password"]) && isset($_POST["pin"]) && isset($_POST["tel"])
) {

    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $con_password = mysqli_real_escape_string($conn, $_POST["con-password"]);
    $pin = mysqli_real_escape_string($conn, $_POST["pin"]);
    $tel = mysqli_real_escape_string($conn, $_POST["tel"]);

    $filemp = $_FILES['file_img']['tmp_name'];
    $filename = ($_FILES['file_img']['name']);
    $filetype = $_FILES['file_img']['type'];
    $filesize = $_FILES['file_img']['size'];
    $target_file = $filename . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $filepath = 'img/' . $filename;

    $sql_get_data = "SELECT * FROM user_bebboo_tb";
    $result_get_data = $conn->query($sql_get_data);

    if ($result_get_data->num_rows > 0) {
        $row = $result_get_data->fetch_assoc();
        $email_tb = $row['email'];
    } else {
        $email_tb = '';
    }

    if (empty($username) || empty($email) || empty($password) || empty($con_password) || empty($pin) || empty($tel)) {
        $_SESSION["ERROR_RE"] = "Please fill in all the required fields.";
        header("Location: register.php");
        exit();
    } elseif ($email == $email_tb) {
        $_SESSION["ERROR_RE"] = "This email is already in use.";
        header("Location: register.php");
        exit();
    } elseif (strlen($password) < 8) {
        $_SESSION["ERROR_RE"] = "Password should have at least 8 characters.";
        header("Location: register.php");
        exit();
    } elseif ($filesize > 5000000) {
        $_SESSION["ERROR_RE"] = "Sorry, your file is too large. Maximum file size is 5 MB.";
        header("Location: register.php");
        exit();
    } elseif (!in_array($imageFileType, ['png', 'jpg', 'jpeg'])) {
        $_SESSION["ERROR_RE"] = "Sorry, only PNG, JPG, and JPEG files are allowed.";
        header("Location: register.php");
        exit();
    } elseif (strlen($email) < 10) {
        $_SESSION["ERROR_RE"] = "Email should have at least 10 characters.";
        header("Location: register.php");
        exit();
    } elseif (strlen($username) < 8) {
        $_SESSION["ERROR_RE"] = "The username should be longer.";
        header("Location: register.php");
        exit();
    } elseif (empty($tel)) {
        $_SESSION["ERROR_RE"] = "Please enter your telephone number.";
        header("Location: register.php");
        exit();
    } elseif (strlen($tel) != 10) {
        $_SESSION["ERROR_RE"] = "Telephone number should have exactly 10 digits.";
        header("Location: register.php");
        exit();
    } elseif ($password != $con_password) {
        $_SESSION["ERROR_RE"] = "Passwords don't match.";
        header("Location: register.php");
        exit();
    } else {
        $cheak_email = "SELECT * FROM user_bebboo_tb WHERE Email='$email'";
        $query_email = mysqli_query($conn, $cheak_email);

        if (mysqli_num_rows($query_email) > 0) {
            $_SESSION["ERROR_RE"] = "Email address is already used.";
            header("Location: register.php");
            exit();
        } else {
            move_uploaded_file($filemp, $filepath);
            $hash_password = password_hash($password, PASSWORD_DEFAULT);
            $query_account = "INSERT INTO user_bebboo_tb(username, email, password_, avatar, pin, tel, rule) VALUES ('$username', '$email', '$hash_password', '$filepath', '$pin', '$tel', 'member')";
            $call_back_query_account = mysqli_query($conn, $query_account);

            if ($call_back_query_account) {
                $_SESSION["confirm_pass"] = "Successfully registered.";
                header("Location: register.php");
                exit();
            } else {
                $_SESSION["ERROR_RE"] = "Register is failed.";
                header("Location: register.php");
                exit();
            }
        }
    }
} else {
    $_SESSION["ERROR_RE"] = "Invalid request.";
    header("Location: register.php");
    exit();
}
?>
