<?php
include("conn.php"); ?>

<?php
session_start();

if (
    isset($_POST["email"]) && isset($_POST["pin"]) && isset($_POST["tel"]) && isset($_POST["password"]) && isset($_POST["con-password"])
);

$email = mysqli_real_escape_string($conn, $_POST["email"]);
$password = mysqli_real_escape_string($conn, $_POST["password"]);
$con_password = mysqli_real_escape_string($conn, $_POST["con-password"]);
$pin = mysqli_real_escape_string($conn, $_POST["pin"]);
$tel = mysqli_real_escape_string($conn, $_POST["tel"]);



if (empty($email)) {
    $_SESSION["ERROR_RE"] = "Plaes enter your Email";
    die(header("Location:forgetpass.php"));
} elseif (empty($pin)) {
    $_SESSION["ERROR_RE"] = "Plaes enter your pin";
    die(header("Location:forgetpass.php"));
} elseif (empty($tel)) {
    $_SESSION["ERROR_RE"] = "Plaes enter your tel";
    die(header("Location:forgetpass.php"));
} elseif (empty($password)) {
    $_SESSION["ERROR_RE"] = "Plaes enter your Password";
    die(header("Location:forgetpass.php"));
} elseif (empty($con_password)) {
    $_SESSION["ERROR_RE"] = "Plaes enter your Confirm-Password";
    die(header("Location:forgetpass.php"));
} elseif ($password != $con_password) {
    $_SESSION["ERROR_RE"] = "Passwords don't match";
    die(header("Location:forgetpass.php"));
} else {
    $check_accout_query = "SELECT * FROM user_bebboo_tb WHERE email='$email'OR pin='$pin' OR tel='$tel'";
    $query = mysqli_query($conn, $check_accout_query);
    $row = mysqli_fetch_assoc($query);
    if ($row["email"] != $email) {
        $_SESSION["ERROR_RE"] = "Email is fail";
        die(header("Location:forgetpass.php"));
    }
    if ($row["pin"] != $pin) {
        $_SESSION["ERROR_RE"] = "Pin is fail";
        die(header("Location:forgetpass.php"));
    }
    if ($row["tel"] != $tel) {
        $_SESSION["ERROR_RE"] = "Tel is fail";
        header('Location:forgetpass.php');
    } else {
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $update_query = "UPDATE user_bebboo_tb SET password_ = '$hash_password' WHERE email = '$email'";

        if ($conn->query($update_query) === TRUE) {
            $_SESSION["confirm_pass"] = " Password change completed.";
            header('Location:forgetpass.php');
        } else {
            echo "เกิดข้อผิดพลาดในการอัพเดตรหัสผ่าน: " . $conn->error;
        }
    }
}
